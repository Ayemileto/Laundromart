<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\LocationsModel;
use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use App\Models\OrderShippingsModel;

class OrderController extends BaseController
{
    public function __construct()
    {
        $this->LocationsModel       =  new LocationsModel();
        $this->OrderModel           =  new OrderModel();
        $this->OrderDetailsModel    =  new OrderDetailsModel();
        $this->OrderShippingsModel  =  new OrderShippingsModel();
    }

	public function index($status)
	{
        $status = strtolower($status);
        $title = $current_nav = $status.'_orders';
        $this->OrderModel->select('orders.*, invoices.total_due, invoices.status as payment_status');

        if(in_array($status, ['pending', 'active', 'completed', 'cancelled']))
        {
            $this->OrderModel->where('orders.status', $status);
        }

        $this->OrderModel->join('invoices', 'invoices.id = orders.invoice_id');
        $this->OrderModel->where('orders.user_id', userId());

        $data = [
            'view'              => 'user/orders/index',
            'parent_nav'        => 'orders',
            'current_nav'       => $current_nav ?? 'orders',

            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'orders'            => $this->OrderModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->OrderModel->pager,
        ];

        echo view(userLayout(), $data);
    }

    public function view($id)
    {
        $data['order'] = $this->OrderModel->where('id', $id)->where('user_id', userId())->first();
        
        $this->OrderDetailsModel->select('order_details.*, products.name as product_name,
                                            product_services.name as product_service_name');
        $this->OrderDetailsModel->where('order_id', $data['order']['id']);
        $this->OrderDetailsModel->join('products', 'products.id = order_details.product_id');
        $this->OrderDetailsModel->join('product_services', 'product_services.id = order_details.product_service_id');

        $data['order_details']      = $this->OrderDetailsModel->get()->getResultArray();

        if($data['order']['has_shipping'] == 'yes')
        {
            $data['shipping_details']   = $this->OrderShippingsModel->where('order_id', $data['order']['id'])->first();

            if(!empty($data['shipping_details']))
            {
                $data['location_details'] = $this->LocationsModel->where('id', $data['shipping_details']['location_id'])->first();
            }
        }

        if($data['order']['has_custom_items'] == 'yes')
        {
            $OrderCustomItemsModel = new \App\Models\OrderCustomItemsModel();
            $data['custom_items']   = $OrderCustomItemsModel->where('order_id', $data['order']['id'])->findAll();
        }


        echo view(adminTheme().'/user/orders/view', $data);
    }
}
