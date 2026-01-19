<?php namespace App\Controllers\PaymentGateways;
use App\Controllers\BaseController;
use App\Controllers\InvoiceController;
use App\Models\InvoiceModel;
use App\Models\PaymentGatewaysModel;

class PaystackController extends BaseController
{
    private $curl;
    private $paystackData;

    public function __construct()
    {
        $this->InvoiceController = new InvoiceController();
        $this->InvoiceModel = new InvoiceModel();
        $this->PaymentGatewaysModel = new PaymentGatewaysModel();

        $this->paystackData = $this->PaymentGatewaysModel
                                ->where('name', 'Paystack')
                                ->first();


        $this->curl = $this->curlSetup();
    }

    public function curlSetup()
    {
        $options = [
            'base_uri'    => 'https://api.paystack.co/transaction/',
            'verify'      => true,
            'http_errors' => false,
            'headers'     => [
                    'Authorization' => 'Bearer '.$this->paystackData['secret_key'],
                    'Cache-Control' => 'no-cache',
            ]
        ];
        return \Config\Services::curlrequest($options);
    }

    public function cancelledPayment()
    {

    }

    public function failedPayment()
    {

    }

    public function initiatePayment($invoice_reference, $total_price, $tax, $total_due, $data, $user)
    {
        $total_due *= 100;

        $response = $this->curl->request('post', 'initialize',
                        [
                            // 'form_params'  =>
                            'json'  =>
                            [
                                'email'     => $user['email'],
                                'amount'    => $total_due,
                                // 'quantity'  => 1,
                                'currency'  => $this->paystackData['currency'],


                                'metadata'  => [
                                    'invoice_reference' => $invoice_reference,
                                    'user_id'           => $user['id'],
                                    "custom_fields"     => [
                                        [
                                            "display_name"=>"Invoice ID",
                                            "variable_name"=>"Invoice ID",
                                            "value"=>209
                                        ],
                                        [
                                            "display_name"=>"Cart Items",
                                            "variable_name"=>"cart_items",
                                            "value"=>"3 bananas, 12 mangoes"
                                        ]
                                    ],
                                ],

                                'callback_url'  => fullUrl(route_to('payment_success_url', 'paystack')),
                                'cancel_action' => fullUrl(route_to('payment_cancel_url', 'paypal', $invoice_reference)),
                            ]
                        ]
                    );

        if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
        {
            $response = json_decode($response->getBody());

            if($response->status)
            {
                return redirect()->to($response->data->authorization_url);
            }
        }

        return redirect()->to(previousUrl())->with('alert-error', lang('Site.unable_to_initiate_payment'));
    }

    public function processWebHook()
    {

    }

    public function successfulPayment()
    {
        $payment_reference = $_GET['reference'] ?? $_GET['trxref'];

        if(!empty($payment_reference))
        {
            $response = $this->curl->request('GET', "verify/$payment_reference");

            if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
            {
                $response = json_decode($response->getBody());

                if($response->status)
                {
                    if($response->data->status == 'success')
                    {
                        $amountPaid         = $response->data->amount/100;
                        $currency           = $response->data->currency;
                        $invoice_reference  = $response->data->metadata->invoice_reference;
                        
                        
                        $this->InvoiceController->markInvoiceAsPaid($invoice_reference, $amountPaid, "Paystack", $payment_reference);
                        return "success";
                    }
                }
            }
        }

        return "failed";
    }
}