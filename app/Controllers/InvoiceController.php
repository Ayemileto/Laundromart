<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\SubscriptionModel;

class InvoiceController extends BaseController
{
    public function __construct()
    {
        $this->InvoiceModel         = new InvoiceModel();
        $this->SubscriptionModel    = new SubscriptionModel();
    }

	public function index()
	{
		//
    }
    
    public function createInvoice($invoice_data, $total_price, $invoice_type)
    {
        helper('text');
        $data = [
            'reference'         => random_string('crypto', 16), 
            'items'             => json_encode($invoice_data),
            'item_type'         => $invoice_type,
            'total_price'       => $total_price,
            'tax'               => getTax($total_price),
            'total_due'         => $total_price + getTax($total_price),
            'user_id'           => userId()
        ];

        $this->InvoiceModel->insert($data);
        
        $invoice_id = $this->InvoiceModel->insertID();
        sendInvoiceCreatedEmail(userEmail(), $invoice_id);

        return $invoice_id;
    }

    public function updateInvoice($invoice_id, $data)
    {

    }

    public function pay($reference)
    {
        $invoice = $this->InvoiceModel->where('reference', $reference)->first();

        if(empty($invoice))
        {
            return redirect()->to(previousUrl())->with('alert-error', lang('Site.invoice_not_found'));
        }

        if($invoice['status'] == 'paid')
        {
            return redirect()->to(fullUrl(route_to('user_route_view_invoice', $invoice['id'])))->with('alert-error', lang('Site.invoice_already_paid'));
        }


        $paymentGatewaysModel = new \App\Models\PaymentGatewaysModel();
        $paymentGatewaysModel->where('is_enabled', 'yes');

        $encrypter = \Config\Services::Encrypter();
        $encrypted_ref = $encrypter->encrypt($reference);
        
        $data = [
            'view'              => 'pages/pay',
            'title'             => lang('Site.payment_summary'),
            'description'       => lang('Site.payment_summary'),
            'invoice'           => $invoice,
            'e_invoice'         => base64_encode($encrypted_ref),
            'payment_methods'   => $paymentGatewaysModel->findAll(),
       ];

        return view(frontLayout(), $data);
    }

    public function do_pay($reference)
    {
        if(empty($this->request->getPost('invoice_id')) || empty($this->request->getPost('payment_method')))
        {
            return redirect()->to(previousUrl())->with('alert-error', lang('Site.unable_to_initiate_payment'));
        }

        $encrypter = \Config\Services::Encrypter();
        $reference = $encrypter->decrypt(base64_decode($this->request->getPost('invoice_id')));
        
        $invoice = $this->InvoiceModel->where('reference', $reference)->first();

        if(empty($invoice))
        {
            return redirect()->to(fullUrl(route_to('user_route_invoices', 'all')))->with('alert-error', lang('Site.invoice_not_found'));
        }
        
        if($invoice['status'] == 'paid')
        {
            return redirect()->to(fullUrl(route_to('user_route_view_invoice', $invoice['id'])))->with('alert-error', lang('Site.invoice_already_paid'));
        }
        

        $payment_method = $this->request->getPost('payment_method');
        $user = $this->AuthModel->where('id', $invoice['user_id'])->first();
        
        $paymentController  = new \App\Controllers\PaymentController();
        return $paymentController->initiatePayment(
                    $payment_method,
                    $reference,
                    $invoice['total_price'],
                    $invoice['tax'],
                    $invoice['total_due'],
                    json_decode($invoice['items'], true),
                    $user
                );
    }

    public function markInvoiceAsFailed($invoice_reference)
    {
        $this->InvoiceModel->set([
            'status'            => 'failed',
        ]);
        $this->InvoiceModel->where('reference', $invoice_reference);
        $this->InvoiceModel->update();
    }

    public function markInvoiceAsPaid($invoice_reference, $amountPaid, $payment_method, $payment_reference, $note = NULL)
    {
        $invoice = $this->InvoiceModel->where('reference', $invoice_reference)->first();
        $AuthModel = new \App\Models\AuthModel();
        $email = $AuthModel->getUserEmail($invoice['user_id']);

        if(!empty($invoice) && $invoice['status'] != 'paid')
        {           
            $this->InvoiceModel->set([
                'total_paid'            => $amountPaid,
                'payment_reference'     => $payment_reference,
                'payment_method'        => $payment_method,
                'status'                => 'paid',
                'note'                  => empty($invoice['note']) ? $note : $invoice['note'].'<br>'.$note,
            ]);
            $this->InvoiceModel->where('id', $invoice['id']);
            $this->InvoiceModel->update();

            sendInvoicePaidEmail($email, $invoice['id']);

            if($invoice['item_type'] == 'subscription')
            {
                $subscription_data = json_decode($invoice['items'])->subscription;

                if(!empty($subscription_data->is_renewal)
                    && $subscription_data->is_renewal === true
                    && !empty($subscription_data->previous_id))
                {
                    $previous_subscription = $this->SubsciptionModel
                                                ->where("id", $previous_id)
                                                ->where("user_id", $invoice["user_id"])
                                                ->where("plan_id", $subscription_data->plan_id)
                                                ->first();
                }

                if(!empty($previous_subscription))
                { // RENEW / EXTEND EXISTING SUBSCRIPTION
                    if($this->renewSubscription($previous_subscription, $subscription_data))
                    {
                        $subscription_id = $previous_subscription['id'];
                    }
                }
                else
                { // CREATE NEW SUBSCRIPTION
                    $subscription_id = $this->newSubscription($invoice, $subscription_data);
                }
                
                if(is_numeric($subscription_id))
                {
                    sendSubscriptionConfirmedEmail($email, $subscription_id);
                }
                
                return true;
            }
            else
            {
                $OrderModel = new \App\Models\OrderModel();

                $previous_order = $OrderModel->where('invoice_id', $invoice['id'])->first();
                if(!empty($previous_order))
                {// AN ORDER ALREADY EXISTED FOR THIS INVOICE
                    return true;
                }
                
                $order_items = json_decode($invoice['items'], true);
                $OrderModel->insert([
                    'user_id'       => $invoice['user_id'],
                    'invoice_id'    => $invoice['id'],
                    'status'        => 'active',
                    'has_shipping'  => !empty($order_items['shipping']) ? 'yes' : 'no',
                    'has_custom_items'  => !empty($order_items['custom_items']) ? 'yes' : 'no',
                ]);
                
                $order_id = $OrderModel->insertID();

                if(!empty($order_id))
                {
                    if(!empty($order_items['items']))
                    {
                        $items = $order_items['items'];
    
                        $insert_data = [];
    
                        foreach($items as $item)
                        {
                            $insert_data[] = [
                                'user_id'               => $invoice['user_id'],
                                "order_id"              => $order_id,
                                "product_id"            => $item['product_id'],
                                "product_service_id"    => $item['product_service_id'],
                                "quantity"              => $item['quantity'],
                                "unit_price"            => $item['unit_price'],
                                "total_price"           => $item['total_price'],
                            ];   
                        }
    
                        $OrderDetailsModel = new \App\Models\OrderDetailsModel();
                        $OrderDetailsModel->insertBatch($insert_data);
                    }

                    if(!empty($order_items['custom_items']))
                    {
                        $items = $order_items['custom_items'];
    
                        $insert_data = [];
    
                        foreach($items as $item)
                        {
                            $insert_data[] = [
                                'user_id'       => $invoice['user_id'],
                                "order_id"      => $order_id,
                                "name"          => $item['name'],
                                "price"         => $item['price'],
                            ];   
                        }
    
                        $OrderCustomItemsModel = new \App\Models\OrderCustomItemsModel();
                        $OrderCustomItemsModel->insertBatch($insert_data);
                    }

                    if(!empty($order_items['shipping']))
                    {
                        $shipping = $order_items['shipping'];

                        $OrderShippingsModel = new \App\Models\OrderShippingsModel();
                        $OrderShippingsModel->insert([
                            'user_id'           => $invoice['user_id'],
                            'order_id'          => $order_id,
                            'location_id'       => $shipping['location'],
                            'firstname'         => $shipping['firstname'],
                            'lastname'          => $shipping['lastname'],
                            'address'           => $shipping['address'],
                            'address2'          => $shipping['address2'],
                            'pickup_date'       => $shipping['pickup_date'],
                            'pickup_time'       => $shipping['pickup_time'],
                            'delivery_date'     => $shipping['delivery_date'],
                            'delivery_time'     => $shipping['delivery_time'],
                            'shipping_type'     => $shipping['shipping_type'],
                        ]);
                    }

                    sendOrderConfirmedEmail($email, $order_id);
                }
                return true;
            }
        }
        
        return true;
    }

    public function newSubscription($invoice, $subscription_data)
    {
        $validity_period = $subscription_data->duration;
        $expiry_date = date("Y-m-d H:i:s", strtotime("+$validity_period"));

        $this->SubscriptionModel->insert([
            'invoice_id'        => $invoice['id'],
            'user_id'           => $invoice['user_id'],
            'duration'          => $subscription_data->duration,
            'plan_id'           => $subscription_data->plan_id,
            'subscription_date' => date('Y-m-d H:i:s'),
            'expiry_date'       => $expiry_date,
            'status'            => 'active',
        ]);

        return $this->SubscriptionModel->insertID();
    }

    public function renewSubscription($previous_subscription, $subscription_data)
    {
        $validity_period = $subscription_data->duration;
        $previous_expiry_date = $previous_subscription["expiry_date"];

        if($previous_expiry_date > date("Y-m-d H:i:s"))
        {
            $expiry_date = date("Y-m-d H:i:s", strtotime("+$validity_period", $previous_expiry_date));
        }
        else
        {
            $expiry_date = date("Y-m-d H:i:s", strtotime("+$validity_period"));
        }

        return $this->SubscriptionModel->update([
            'renewal_date'      => date('Y-m-d H:i:s'),
            'duration'          => $subscription_data->duration,
            'expiry_date'       => $expiry_date,
            'status'            => 'active',
        ])->where("id", $previous_subscription['id']);
    }
}
