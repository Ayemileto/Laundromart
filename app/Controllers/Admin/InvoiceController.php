<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\PaymentGatewaysModel;

class InvoiceController extends BaseController
{
    public function __construct()
    {
        $this->InvoiceModel             =  new InvoiceModel();
        $this->paymentGatewaysModel     = new PaymentGatewaysModel();
    }

    public function create()
    {
        $this->paymentGatewaysModel->where('is_enabled', 'yes');

        $data = [
            'view'              => 'admin/invoices/create',
            'parent_nav'        => 'invoices',
            'current_nav'       => 'create_invoice',
            'title'             => lang('Site.create_invoice'),
            'meta_description'  => lang('Site.create_invoice'),
            'payment_methods'   => $this->paymentGatewaysModel->findAll(),
        ];

        echo view(adminLayout(), $data);
    }

    public function save()
    {
        if(!$this->validate([
            'user'              => ['label' => lang('Site.user'),               'rules' => 'required|trim|numeric'],
            'items'             => ['label' => lang('Site.items'),              'rules' => 'required'],
            'prices'            => ['label' => lang('Site.prices'),             'rules' => 'required'],
        ]))
        {
            return $this->fail($this->validator->getErrors());  
        }
        else
        {      
            $items  = $this->request->getPost('items');
            $prices = $this->request->getPost('prices');


            $i = 0;
            $custom_item_price_total = 0;
            $custom_invoice_items = [];

            foreach($items as $item)
            {
                if(!empty($item))
                {
                    $item_price = isset($prices[$i]) && is_numeric($prices[$i]) ? $prices[$i] : 0;
                    $custom_item_price_total += $item_price;

                    $custom_invoice_items[] = [
                        "name"      => $item,
                        "price"     => $item_price,
                        "added_by"  => [
                                        'user_id'   =>  userId(),
                                        'fullname'  =>  lastName().' '.firstName(),
                                    ]
                    ];
                }
                $i++;
            }

            $invoice_items['custom_items']  = $custom_invoice_items;
        
            helper('text');
            $this->InvoiceModel->insert([
                'reference'         => random_string('crypto', 16), 
                'user_id'           => $this->request->getPost('user'),
                'status'            => $this->request->getPost('payment_status') ?? "unpaid",
                'items'             => json_encode($invoice_items),
                'item_type'         => 'custom',
                'total_price'       => $custom_item_price_total,
                'tax'               => getTax($custom_item_price_total),
                'total_due'         => $custom_item_price_total + getTax($custom_item_price_total),
                'payment_method'    => $this->request->getPost('payment_method'),
                'payment_reference' => $this->request->getPost('payment_reference'),
            ]);

            $invoice_id = $this->InvoiceModel->insertId();
            
            sendInvoiceCreatedEmail($this->AuthModel->getUserEmail($this->request->getPost('user')), $invoice_id);

            return $this->respondCreated([
                "status"   => 200,
                "error"    => null,
                "messages"  => "success",
                "redirect_to" => fullUrl(route_to('admin_route_view_invoice', $invoice_id)),
            ]);
        }
    }

    public function index($status)
    {
        $status = strtolower($status);
        $title = $current_nav = $status.'_invoices';
        
        $this->InvoiceModel->select('invoices.*,
             CONCAT(users.firstname," ", users.lastname) as customer_name');

        if(in_array($status, ['paid', 'unpaid']))
        {
            $this->InvoiceModel->where('invoices.status', $status);
        }
        $this->InvoiceModel->join('users', 'invoices.user_id=users.id', 'left');

        $data = [
            'view'              => 'admin/invoices/index',
            'parent_nav'        => 'invoices',
            'current_nav'       => $current_nav ?? 'invoices',
            'page_status'       => $status,
            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'invoices'          => $this->InvoiceModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->InvoiceModel->pager,
        ];

        echo view(adminLayout(), $data);
    }

    public function view(int $id)
    {
        $data['invoice'] = $this->InvoiceModel->where('id', $id)->first();

        if($this->request->isAjax())
        {
            if(empty($data['invoice']))
            {
                show_404();
            }
    
            return view(adminTheme().'/admin/invoices/modal_view', $data);
        }

        $data['view']               = 'admin/invoices/view';
        $data['parent_nav']         = 'invoices';
        $data['title']              = lang('Site.invoice_details');
        $data['meta_description']   = lang('Site.invoice_details');
        // $data['current_nav']   = $current_nav ?? 'invoices';

        echo view(adminLayout(), $data);
    }

    public function addItem($id)
    {
        $data['invoice'] = $this->InvoiceModel->where('id', $id)->first();

        if(empty($data['invoice']))
        {
            show_404();
        }

        return view(adminTheme().'/admin/invoices/add_item', $data);
    }

    public function saveItem()
    {
        $invoice = $this->InvoiceModel->where('id', $this->request->getPost('invoice_id'))->first();
        
        if(empty($invoice))
        {
            show_404();
        }

        $items  = $this->request->getPost('items');
        $prices = $this->request->getPost('prices');


        $i = 0;
        $custom_item_price_total = 0;
        $custom_invoice_items = [];

        foreach($items as $item)
        {
            if(!empty($item))
            {
                $item_price = isset($prices[$i]) && is_numeric($prices[$i]) ? $prices[$i] : 0;
                $custom_item_price_total += $item_price;

                $custom_invoice_items[] = [
                    "name"      => $item,
                    "price"     => $item_price,
                    "added_by"  => [
                                    'user_id'   =>  userId(),
                                    'fullname'  =>  lastName().' '.firstName(),
                                ]
                ];
            }
            $i++;
        }

        $invoice_items = json_decode($invoice['items'], true);
        
        if(!empty($invoice_items['custom_items']))
        {
            $invoice_items['custom_items']  = array_merge($invoice_items['custom_items'], $custom_invoice_items);
        }
        else
        {
            $invoice_items['custom_items']  = $custom_invoice_items;
        }

        $this->InvoiceModel->set([
            'items'         => json_encode($invoice_items),
            'total_price'   => $invoice['total_price'] + $custom_item_price_total,
            'tax'           => getTax($invoice['total_price'] + $custom_item_price_total),
            'total_due'     => $invoice['total_price'] + $custom_item_price_total + getTax($invoice['total_price'] + $custom_item_price_total),
        ]);
        $this->InvoiceModel->where('id', $invoice['id']);
        $this->InvoiceModel->update();

        return $this->respondCreated([
            "status"   => 200,
            "error"    => null,
            "messages"  => "success",
            "redirect_to" => "",
        ]);
    }

    ########
    ### MARK AS PAID
    ########
    public function paid($id)
    {
        $invoice = $this->InvoiceModel->where('id', $id)->first();

        if(empty($invoice))
        {
            show_404();
        }

        $this->paymentGatewaysModel->where('is_enabled', 'yes');

        $data = [
            'invoice'           => $invoice,
            'payment_methods'   => $this->paymentGatewaysModel->findAll(),
        ];

        return view(adminTheme().'/admin/invoices/mark_as_paid', $data);
    }

    public function do_paid()
    {
        $id = $this->request->getPost('invoice_id');
        $reference = $this->request->getPost('reference');
 
        if(!empty($id) && is_numeric($id) && !empty($reference))
        {
            $invoice = $this->InvoiceModel->where('id', $id)->where('reference', $reference)->first();
            if(!empty($invoice))
            {
                if($this->request->getPost('total_paid') < $invoice['total_due'] && empty($this->request->getPost('ignore_less_price')))
                {
                    $error['total_paid']    = lang('Site.total_paid_cannot_be_less_than', [formatMoney($this->request->getPost('total_paid')), formatMoney($invoice['total_due'])]).'<br>';
                    return $this->fail($error);
                }
                $note = lang('Site.marked_as_status_by', ['staff_name' => firstName().' '.lastName(), 'status' => lang('Site.paid')]);
                $note .= ' ('.formatDate(date('Y-m-d')).' '.formatTime(date('H:i:s')).')';

                $invoiceController = new \App\Controllers\InvoiceController();

                $invoiceController->markInvoiceAsPaid(
                    $invoice['reference'],
                    $this->request->getPost('total_paid'),
                    $this->request->getPost('payment_method'),
                    $this->request->getPost('payment_reference') ?? NULL,
                    $note
                );

                return $this->respond([
                    'status'            => 200,
                    'error'             => NULL,
                    'messages'          => 'success',
                    'redirect_to'       => '',
                ]);
            }
        }
        
        return $this->fail(lang('Site.an_error_occurred'));
    }

    ##########
    #### CANCEL PAYMENT
    ##########
    public function cancel($id)
    {
        $invoice = $this->InvoiceModel->where('id', $id)->first();

        if(empty($invoice))
        {
            show_404();
        }

        $data = [
            'invoice'           => $invoice,
        ];

        return view(adminTheme().'/admin/invoices/cancel_payment', $data);
    }

    
    public function do_cancel()
    {
        $id = $this->request->getPost('invoice_id');
        $reference = $this->request->getPost('reference');
        
        if(!empty($id) && is_numeric($id) && !empty($reference))
        {
            $invoice = $this->InvoiceModel->where('id', $id)->where('reference', $reference)->first();
            if(!empty($invoice))
            {
                $staff_name = firstName().' '.lastName();
                $payment_status = lang('Site.'.$this->request->getPost('payment_status'));

                $note = lang('Site.marked_as_status_by', ['staff_name' => $staff_name, 'status' => $payment_status]);
                $note .= ' ('.formatDate(date('Y-m-d')).' '.formatTime(date('H:i:s')).')';

                $update_data['status']  = $this->request->getPost('payment_status');
                $update_data['note'] = empty($invoice['note']) ? $note : $invoice['note'].'<br>'.$note;
                
            }
            if(!empty($update_data))
            {
                $this->InvoiceModel->set($update_data);
                $this->InvoiceModel->where('id', $id);
                if($this->InvoiceModel->update())
                {
                    return $this->respond([
                        'status'            => 200,
                        'error'             => NULL,
                        'messages'          => 'success',
                        'redirect_to'       => '',
                    ]);
                }
            }
        }

        return $this->fail(lang('Site.an_error_occurred'));
    }
}