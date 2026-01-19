<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ShoppingCartModel;

class SubscriptionCartController extends BaseController
{
    public function __construct()
    {
        $this->ShoppingCartModel =  new ShoppingCartModel();
    }

    public function add($subscription_id)
    {
        if(!$this->validate([
            'product_id'        => ['label' => lang('Site.product_id'),         'rules' => 'required|trim|numeric'],
            'product_service'   => ['label' => lang('Site.product_service'),    'rules' => 'required|trim|numeric'],
        ]))
        {
            return $this->fail($this->validator->getErrors());  
        }
        else
        {
            $product_id        = $this->request->getPost('product_id');
            $product_service   = $this->request->getPost('product_service');
            $quantity          = $this->request->getPost('quantity') ?? 1;

            $previous_subscription_cart = $this->ShoppingCartModel
                            ->where('user_id', userId())
                            ->where('product_id', $product_id)
                            ->where('product_service', $product_service)
                            ->where('subscription_id', $subscription_id)
                            ->first();
                
            if(!empty($previous_subscription_cart))
            {
                $insert_data = [
                    'quantity'   => $previous_subscription_cart['quantity'] + $quantity,
                ];
                
                $this->ShoppingCartModel->set($insert_data);
                $this->ShoppingCartModel->where('user_id', userId());
                $this->ShoppingCartModel->where('product_id', $product_id);
                $this->ShoppingCartModel->where('product_service', $product_service);
                $insert = $this->ShoppingCartModel->update();
            }
            else
            {
                $insert_data = [
                    'user_id'           => userId(),
                    'product_id'        => $product_id,
                    'product_service'   => $product_service,
                    'quantity'          => $quantity,
                    'subscription_id'   => $subscription_id
                ];

                $this->ShoppingCartModel->save($insert_data);
            }

            return $this->respondCreated(
            [
                'status'                => 200,
                'error'                 => NULL,
                'messages'              => lang('Site.success'),
                'js_callback_function'  => "RefreshProductSummaryTable",
            ]);
        }

    }

    public function summary($subscription_id)
    {
        $data['subscription_cart'] = $this->ShoppingCartModel->select(
                            'shopping_cart.*, products.file,
                            products.name as product_name, 
                            product_services.name as service_name',
                        )
                        ->where('shopping_cart.user_id', userId())
                        ->where('shopping_cart.subscription_id', $subscription_id)
                        ->join('products', 'products.id = shopping_cart.product_id')
                        ->join('product_services', 'product_services.id = shopping_cart.product_service')
                        ->findAll();

        echo view(userTheme().'/user/subscription_cart/order_summary', $data);
    }

    public function delete($subscription_id, $product_id, $product_service)
    {
        $this->ShoppingCartModel
            ->where('user_id', userId())
            ->where('subscription_id', $subscription_id)
            ->where('product_id', $product_id)
            ->where('product_service', $product_service);
        
        if($this->ShoppingCartModel->delete())
        {
            return $this->respondCreated(
            [
                'status'    => 200,
                'error'     => NULL,
                'messages'  => lang('Site.success'),
            ]);
        }
    }
}