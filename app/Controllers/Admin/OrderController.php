<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\LocationsModel;
use App\Models\OrderDetailsModel;
use App\Models\OrderShippingsModel;
use App\Models\ProductModel;
use App\Models\ShoppingCartModel;

class OrderController extends BaseController
{
    public function __construct()
    {
        $this->LocationsModel       =  new LocationsModel();
        $this->OrderModel           =  new OrderModel();
        $this->OrderDetailsModel    =  new OrderDetailsModel();
        $this->OrderShippingsModel  =  new OrderShippingsModel();
        $this->ProductModel         =  new ProductModel();
        $this->ShoppingCartModel    =  new ShoppingCartModel();
    }

	public function index($status)
	{
        $status = strtolower($status);
        $title = $current_nav = $status.'_orders';

        $this->OrderModel->select('orders.*,
             CONCAT(users.firstname," ", users.lastname) as customer_name,
             invoices.total_due, invoices.total_paid, invoices.status as payment_status
        ');

        if(in_array($status, ['pending', 'active', 'completed', 'cancelled']))
        {
            $this->OrderModel->where('orders.status', $status);
        }


        $this->OrderModel->join('users', 'orders.user_id=users.id', 'left');
        $this->OrderModel->join('invoices', 'invoices.id = orders.invoice_id', 'left');

        $data = [
            'view'              => 'admin/orders/index',
            'parent_nav'        => 'orders',
            'current_nav'       => $current_nav ?? 'orders',
            'page_status'       => $status,
            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'orders'            => $this->OrderModel->orderBy('id', 'DESC')->paginate(100),
            'pager'             => $this->OrderModel->pager,
        ];

        echo view(adminLayout(), $data);
    }
    

    public function view($id)
    {
        $data['order']             = $this->OrderModel->where('id', $id)->first();
        
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


        echo view(adminTheme().'/admin/orders/view', $data);
    }

    public function create()
    {
        $data = [
            'view'              => 'admin/orders/create',
            'parent_nav'        => 'orders',
            'current_nav'       => 'create_order',
            'title'             => lang('Site.create_order'),
            'meta_description'  => lang('Site.create_order'),
            'products'          => $this->ProductModel->where('status', 'active')->findAll()
        ];

        echo view(adminLayout(), $data);
    }

    public function addProduct()
    {
        if(!$this->validate([
            'user'              => ['label' => lang('Site.user'),               'rules' => 'required|trim|numeric'],
            'product_id'        => ['label' => lang('Site.product_id'),         'rules' => 'required|trim|numeric'],
            'product_service'   => ['label' => lang('Site.product_service'),    'rules' => 'required|trim|numeric'],
        ]))
        {
            return $this->fail($this->validator->getErrors());  
        }
        else
        {
            $user_id           = $this->request->getPost('user');
            $product_id        = $this->request->getPost('product_id');
            $product_service   = $this->request->getPost('product_service');
            $quantity          = $this->request->getPost('quantity') ?? 1;

            $previous_subscription_cart = $this->ShoppingCartModel
                            ->where('user_id', $user_id)
                            ->where('product_id', $product_id)
                            ->where('product_service', $product_service)
                            ->where('subscription_id', NULL)
                            ->first();
                
            if(!empty($previous_subscription_cart))
            {
                $insert_data = [
                    'quantity'   => $previous_subscription_cart['quantity'] + $quantity,
                ];
                
                $this->ShoppingCartModel->set($insert_data);
                $this->ShoppingCartModel->where('user_id', $user_id);
                $this->ShoppingCartModel->where('product_id', $product_id);
                $this->ShoppingCartModel->where('product_service', $product_service);
                $insert = $this->ShoppingCartModel->update();
            }
            else
            {
                $insert_data = [
                    'user_id'           => $user_id,
                    'product_id'        => $product_id,
                    'product_service'   => $product_service,
                    'quantity'          => $quantity
                ];

                $this->ShoppingCartModel->save($insert_data);
            }

            return $this->respondCreated(
            [
                'status'                        => 200,
                'error'                         => NULL,
                'messages'                      => lang('Site.success'),
                'js_callback_function'          => 'RefreshUserCartSummaryTable',
                'js_callback_function_params'   => $user_id
            ]);
        }
    }

    public function userCart()
    {
        if(!empty($this->request->getGet('user')) && is_numeric($this->request->getGet('user')))
        {
            $data['user_cart'] = $this->ShoppingCartModel->select(
                            'shopping_cart.*, products.file,
                            products.name as product_name, 
                            product_services.name as service_name',
                        )
            ->where('shopping_cart.user_id', $this->request->getGet('user'))
            ->where('shopping_cart.subscription_id', NULL)
            ->join('products', 'products.id = shopping_cart.product_id')
            ->join('product_services', 'product_services.id = shopping_cart.product_service')
            ->findAll();

            echo view(adminTheme().'/admin/orders/user_cart', $data);
        }
    }

    public function edit($id)
    {

    }
    
    public function cancel($id)
    {
        $this->OrderModel->set(['status' => 'cancelled']);
        $this->OrderModel->where('id', $id);
        if($this->OrderModel->update())
        {
            return $this->respond([
                'status'            => 200,
                'error'             => NULL,
                'messages'          => 'success',
                'refresh_page'      => true,
            ]);
        }

        return $this->fail('An Error Occurred.');
    }

    public function complete($id)
    {
        $order = $this->OrderModel->where('id', $id)->first();
        
        if($order)
        {
            $this->OrderModel->set(['completed_at' => date('Y-m-d h:i:s'), 'status' => 'completed']);
            $this->OrderModel->where('id', $id);
            if($this->OrderModel->update())
            {
                
                return $this->respond([
                    'status'  => 200,
                    'error'   => NULL,
                    'messages' => 'success',
                ]);
            }
        }

        return $this->fail('Order not Found.');
    }
}
