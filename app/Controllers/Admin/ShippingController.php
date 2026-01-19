<?php namespace App\Controllers\Admin;
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
             CONCAT(users.firstname," ", users.lastname) as customer_name,
             locations.name as location_name, locations.zipcode as location_zipcode
        ');
        $this->OrderShippingsModel->where('order_shippings.shipping_type', 'pickup_only');
        $this->OrderShippingsModel->orwhere('order_shippings.shipping_type', 'pickup_delivery');

        if(in_array($status, ['pending', 'failed', 'completed']))
        {
            $this->OrderShippingsModel->where('order_shippings.pickup_status', $status);
        }


        $this->OrderShippingsModel->join('users', 'order_shippings.user_id=users.id', 'left');
        $this->OrderShippingsModel->join('orders', 'order_shippings.order_id=orders.id', 'left');
        $this->OrderShippingsModel->join('locations', 'order_shippings.location_id=locations.id', 'left');

        $data = [
            'view'              => 'admin/shippings/pickup',
            'parent_nav'        => 'shippings',
            'current_nav'       => $current_nav ?? 'shippings',
            'page_status'       => $status,
            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'shippings'         => $this->OrderShippingsModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->OrderShippingsModel->pager,
        ];

        echo view(adminLayout(), $data);
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
             CONCAT(users.firstname," ", users.lastname) as customer_name,
             locations.name as location_name, locations.zipcode as location_zipcode
        ');
        $this->OrderShippingsModel->where('order_shippings.shipping_type', 'delivery_only');
        $this->OrderShippingsModel->orwhere('order_shippings.shipping_type', 'pickup_delivery');

        if(in_array($status, ['pending', 'failed', 'completed']))
        {
            $this->OrderShippingsModel->where('order_shippings.delivery_status', $status);
        }


        $this->OrderShippingsModel->join('users', 'order_shippings.user_id=users.id', 'left');
        $this->OrderShippingsModel->join('orders', 'order_shippings.order_id=orders.id', 'left');
        $this->OrderShippingsModel->join('locations', 'order_shippings.location_id=locations.id', 'left');

        $data = [
            'view'              => 'admin/shippings/delivery',
            'parent_nav'        => 'shippings',
            'current_nav'       => $current_nav ?? 'shippings',
            'page_status'       => $status,
            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'shippings'         => $this->OrderShippingsModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->OrderShippingsModel->pager,
        ];

        echo view(adminLayout(), $data);
    }


    public function complete($type, $id)
    {
        $details = $this->OrderShippingsModel
        ->select('order_shippings.*, (SELECT email FROM users WHERE users.id=order_shippings.user_id) as email')
        ->where('order_shippings.id', $id)->first();

        if(!empty($details))
        {
            $email = $details['email'];
            if($type == 'pickup')
            {
                $update_array = ['pickup_status', 'completed'];
                sendPickupSuccessfulEmail($email);
            }
            
            if($type == 'delivery')
            {
                $update_array = ['delivery_status', 'completed'];
                sendDeliverySuccessfulEmail($email);
            }

            if(!empty($update_array))
            {
                $this->OrderShippingsModel->set($update_array);
                $this->OrderShippingsModel->where('id', $id);
                if($this->OrderShippingsModel->update())
                {
                    return $this->respond([
                        'status'            => 200,
                        'error'             => NULL,
                        'messages'          => 'success',
                        'refresh_page'      => true,
                    ]);
                }
            }
        }

        return $this->fail('An Error Occurred.');
    }

    public function failed($type, $id)
    {
        $details = $this->OrderShippingsModel
        ->select('order_shippings.*, (SELECT email FROM users WHERE users.id=order_shippings.user_id) as email')
        ->where('order_shippings.id', $id)->first();

        if(!empty($details))
        {
            $email = $details['email'];

            if($type == 'pickup')
            {
                $update_array = ['pickup_status', 'failed'];
                sendPickupFailedEmail($email);
            }
            
            if($type == 'delivery')
            {
                $update_array = ['delivery_status', 'failed'];
                sendDeliveryFailedEmail($email);
            }
    
            if(!empty($update_array))
            {
                $this->OrderShippingsModel->set($update_array);
                $this->OrderShippingsModel->where('id', $id);
                if($this->OrderShippingsModel->update())
                {
                    return $this->respond([
                        'status'            => 200,
                        'error'             => NULL,
                        'messages'          => 'success',
                        'refresh_page'      => true,
                    ]);
                }
            }
        }

        return $this->fail('An Error Occurred.');
    }


    public function edit($type, $id)
    {
        $shipping = $this->OrderShippingsModel->where("id", $id)->first();

        if(empty($shipping))
        {
            show_404();
        }

        $data = [
            "shipping"              => $shipping,
        ];


        if($type == 'pickup')
        {
            return view(adminTheme().'/admin/shippings/edit_pickup', $data);
        }
        
        if($type == 'delivery')
        {
            return view(adminTheme().'/admin/shippings/edit_delivery', $data);
        }
    }

    public function update()
    {
        $id = $this->request->getPost('shipping_id');
        $details = $this->OrderShippingsModel
        ->select('order_shippings.*, (SELECT email FROM users WHERE users.id=order_shippings.user_id) as email')
        ->where('order_shippings.id', $id)->first();

        $update_array               = $this->request->getPost();

        if(!empty($details) && !empty($update_array))
        {
            $email = $details['email'];

            if( (!empty($this->request->getPost('pickup_date')) &&
                    $this->request->getPost('pickup_date') != $details['pickup_date']) 
            || (!empty($this->request->getPost('pickup_time')) &&
                    $this->request->getPost('pickup_time') != $details['pickup_time'])    
            )
            {// IF PICKUP DATE OR PICKUP TIME CHANGED, SEND UPDATED SCHEDULE
                $pickup_time = $this->request->getPost('pickup_date').' '.$this->request->getPost('pickup_time');
                sendPickupScheduledEmail($email, $pickup_time);
            }

            if( (!empty($this->request->getPost('delivery_date')) &&
                    $this->request->getPost('delivery_date') != $details['delivery_date']) 
            || (!empty($this->request->getPost('delivery_time')) &&
                    $this->request->getPost('delivery_time') != $details['delivery_time'])    
            )
            {// IF DELIVERY DATE OR DELIVERY TIME CHANGED, SEND UPDATED SCHEDULE
                $delivery_time = $this->request->getPost('delivery_date').' '.$this->request->getPost('delivery_time');
                sendDeliveryScheduledEmail($email, $delivery_time);
            }

            if(!empty($this->request->getPost('pickup_status')) && $this->request->getPost('pickup_status') != $details['pickup_status'])
            {// IF PICKUP STATUS CHANGED
                if($this->request->getPost('pickup_status') == 'failed')
                {
                    sendPickupFailedEmail($email);                
                }
                elseif($this->request->getPost('pickup_status') == 'completed')
                {
                    sendPickupSuccessfulEmail($email);
                }
            }

            if(!empty($this->request->getPost('delivery_status')) && $this->request->getPost('delivery_status') != $details['delivery_status'])
            {// IF DELIVERY STATUS CHANGED
                if($this->request->getPost('delivery_status') == 'failed')
                {
                    sendDeliveryFailedEmail($email);
                }
                elseif($this->request->getPost('delivery_status') == 'completed')
                {
                    sendDeliverySuccessfulEmail($email);
                }
            }

            $this->OrderShippingsModel->set($update_array);
            $this->OrderShippingsModel->where('id', $id);
            if($this->OrderShippingsModel->update())
            {
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

}