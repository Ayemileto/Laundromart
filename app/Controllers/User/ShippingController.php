<?php namespace App\Controllers\User;
use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderShippingsModel;

class ShippingController extends BaseController
{
    private $OrderModel;
    private $OrderShippingsModel;
    
    public function __construct()
    {
        $this->OrderModel           = new OrderModel();
        $this->OrderShippingsModel  = new OrderShippingsModel();
    }

    public function pickups($status)
	{
        $status = strtolower($status);

        if(!in_array($status, ['all', 'pending', 'failed', 'completed']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $title = $current_nav = $status.'_pickups';


        $this->OrderShippingsModel->select('order_shippings.*,
            locations.name as location_name, locations.zipcode as location_zipcode
        ');
        $this->OrderShippingsModel->where('order_shippings.user_id', userId());
        $this->OrderShippingsModel->where('order_shippings.shipping_type', 'pickup_only');
        $this->OrderShippingsModel->orwhere('order_shippings.shipping_type', 'pickup_delivery');

        if(in_array($status, ['pending', 'failed', 'completed']))
        {
            $this->OrderShippingsModel->where('order_shippings.pickup_status', $status);
        }



        $this->OrderShippingsModel->join('orders', 'order_shippings.order_id=orders.id', 'left');
        $this->OrderShippingsModel->join('locations', 'order_shippings.location_id=locations.id', 'left');

        $data = [
            'view'              => 'user/shippings/pickup',
            'parent_nav'        => 'shippings',
            'current_nav'       => $current_nav ?? 'shippings',
            'page_status'       => $status,
            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'shippings'         => $this->OrderShippingsModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->OrderShippingsModel->pager,
        ];

        echo view(userLayout(), $data);
    }

    public function deliveries($status)
	{
        $status = strtolower($status);

        if(!in_array($status, ['all', 'pending', 'failed', 'completed']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $title = $current_nav = $status.'_deliveries';


        $this->OrderShippingsModel->select('order_shippings.*,
            locations.name as location_name, locations.zipcode as location_zipcode
        ');
        $this->OrderShippingsModel->where('order_shippings.user_id', userId());
        $this->OrderShippingsModel->where('order_shippings.shipping_type', 'delivery_only');
        $this->OrderShippingsModel->orwhere('order_shippings.shipping_type', 'pickup_delivery');

        if(in_array($status, ['pending', 'failed', 'completed']))
        {
            $this->OrderShippingsModel->where('order_shippings.delivery_status', $status);
        }

        $this->OrderShippingsModel->join('orders', 'order_shippings.order_id=orders.id', 'left');
        $this->OrderShippingsModel->join('locations', 'order_shippings.location_id=locations.id', 'left');

        $data = [
            'view'              => 'user/shippings/delivery',
            'parent_nav'        => 'shippings',
            'current_nav'       => $current_nav ?? 'shippings',
            'page_status'       => $status,
            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'shippings'         => $this->OrderShippingsModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->OrderShippingsModel->pager,
        ];

        echo view(userLayout(), $data);
    }
}