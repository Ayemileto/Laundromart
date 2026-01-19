<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;

class InvoiceController extends BaseController
{
    public function __construct()
    {
        $this->InvoiceModel           =  new InvoiceModel();
    }

    public function index($status)
    {
        $status = strtolower($status);
        $title = $current_nav = $status.'_invoices';
        
        $this->InvoiceModel->where('user_id', userId());

        if(in_array($status, ['paid', 'unpaid']))
        {
            $this->InvoiceModel->where('invoices.status', $status);
        }

        $data = [
            'view'              => 'user/invoices/index',
            'parent_nav'        => 'invoices',
            'current_nav'       => $current_nav ?? 'invoices',
            'page_status'       => $status,
            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'invoices'          => $this->InvoiceModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->InvoiceModel->pager,
        ];

        echo view(userLayout(), $data);
    }

    public function view(int $id)
    {
        $data['invoice'] = $this->InvoiceModel->where('id', $id)
                                ->where('user_id', userId())
                                ->first();
        if($this->request->isAjax())
        {
            if(empty($data['invoice']))
            {
                show_404();
            }
    
            return view(userTheme().'/user/invoices/modal_view', $data);
        }

        $data['view']               = 'user/invoices/view';
        $data['parent_nav']         = 'invoices';
        $data['title']              = lang('Site.invoice_details');
        $data['meta_description']   = lang('Site.invoice_details');

        echo view(userLayout(), $data);
    }
}