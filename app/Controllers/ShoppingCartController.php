<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ShoppingCartModel;

class ShoppingCartController extends BaseController
{
    public function __construct()
    {
        $this->ShoppingCartModel =  new ShoppingCartModel();
    }


    public function index()
    {   
        if(isLoggedIn())
        {
            $this->ShoppingCartModel->select('shopping_cart.*, products.name, 
            products.file, product_services.name as service_name,
            products_services_prices.price, products_services_prices.discount_price')
            
            ->where('user_id', userId())
            ->where('subscription_id', NULL)

            ->join('products', 'products.id = shopping_cart.product_id')
            ->join('product_services', 'product_services.id = shopping_cart.product_service')
            ->join('products_services_prices', 
                'products_services_prices.service_id = shopping_cart.product_service 
                AND products_services_prices.product_id =  shopping_cart.product_id');

            $cart_data = $this->ShoppingCartModel->get()->getResultArray();
        }
        else
        {
            $cart_data = [];

            $cart_items = $this->session->get('cart')['items'] ?? [];
            
            foreach($cart_items as $item)
            {
                $productModel = new \App\Models\ProductModel();
                
                $product = $productModel->where('id', $item['product_id'])
                            ->where('status', 'active')->first();
                
                if(!empty($product))
                {
                    $productsServicesPricesModel = new \App\Models\ProductsServicesPricesModel();

                    $product_service = $productsServicesPricesModel
                        ->select('products_services_prices.*, product_services.name')
                        ->where('products_services_prices.product_id', $product['id'])
                        ->where('products_services_prices.service_id', $item['product_service'])
                        ->join('product_services', 'product_services.id = service_id')
                        ->first();

                    if(!empty($product_service))
                    {
                        $cart_data[] = [
                            'product_id'        => $product['id'],
                            'name'              => $product['name'],
                            'file'              => $product['file'],
                            'service_name'      => $product_service['name'],
                            'product_service'   => $product_service['service_id'],
                            'price'             => $product_service['price'],
                            'discount_price'    => $product_service['discount_price'],
                            'quantity'          => $item['quantity'],
                        ];
                    }
                }


            }
        }


        $data = [
            'view'              => 'pages/shopping-cart',
            'title'             => getSetting('seo_cart_page_title'),
            'keywords'          => getSetting('seo_cart_page_keywords'),
            'meta_description'  => getSetting('seo_cart_page_description'),
            'cart_data'         => $cart_data,
       ];
        echo view(frontLayout(), $data);
    }

    public function add()
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

            if($quantity < 1)
            {
                return $this->fail(lang('Site.quantity_cannot_be_less_than_1'));
            }

            $cart_data = $this->session->get('cart')['items'] ?? [];
            $already_exist = false;
            
            if(!empty($cart_data))
            {
                $x = 0;

                foreach($cart_data as $cart_item)
                {
                    if($cart_item['product_id'] == $product_id && $cart_item['product_service'] == $product_service)
                    {
                        $cart_data[$x]['quantity'] += $quantity;
                        $already_exist = true;
                        break;
                    }

                    $x++;
                }
            }

            if(!$already_exist)
            {
                $cart_data[] = [
                        'product_id'        => $product_id,
                        'product_service'   => $product_service,
                        'quantity'          => $quantity
                   ];
            }

            $cart['cart']['items'] = $cart_data;
            $cart['cart']['total_items'] = count($cart_data);
            $this->session->set($cart);


            if(isLoggedIn())
            {
                $previous_cart = $this->ShoppingCartModel
                                ->where('user_id', userId())
                                ->where('subscription_id', NULL)
                                ->where('product_id', $product_id)
                                ->where('product_service', $product_service)
                                ->first();
                
                if(!empty($previous_cart))
                {
                    $insert_data = [
                        'quantity'   => $previous_cart['quantity'] + $quantity,
                    ];
                    
                    $this->ShoppingCartModel->set($insert_data);
                    $this->ShoppingCartModel->where('user_id', userId());
                    $this->ShoppingCartModel->where('subscription_id', NULL);
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
                    ];
    
                    $this->ShoppingCartModel->save($insert_data);
                }
            }


            return $this->respondCreated(
            [
                'status'            => 200,
                'error'             => NULL,
                'messages'          => lang('Site.success'),
                'cart_item_count'   => count($cart_data),
            ]);
        }

    }

    public function update()
    {
        $product_id      = $this->request->getPost('product_id');
        $product_service = $this->request->getPost('product_service');
        $quantity        = $this->request->getPost('quantity');
        
        if($quantity < 1)
        {
            return $this->fail(lang('Site.quantity_cannot_be_less_than_1'));
        }

        if(is_numeric($product_id) && is_numeric($product_service) && is_numeric($quantity) && $quantity >= 1)
        {
            $cart_data = $this->session->get('cart')['items'];
            if(!empty($cart_data))
            {
                $x = 0;

                foreach($cart_data as $cart_item)
                {
                    if($cart_item['product_id'] == $product_id && $cart_item['product_service'] == $product_service)
                    {
                        $cart_data[$x]['quantity'] = $quantity;
                        break;
                    }

                    $x++;
                }
            
                $cart['cart']['items'] = $cart_data;
                $cart['cart']['total_items'] = count($cart_data);
                $this->session->set($cart);
            }

            if(isLoggedIn())
            {
                $this->ShoppingCartModel->set(['quantity' => $quantity]);
                $this->ShoppingCartModel
                ->where('user_id', userId())
                ->where('subscription_id', NULL)
                ->where('product_id', $product_id)
                ->where('product_service', $product_service);
                $this->ShoppingCartModel->update();
            }
        }
        
        return $this->respondCreated(
        [
            'status'    => 200,
            'error'     => NULL,
            'messages'  => lang('Site.success'),
        ]);
    }

    public function remove()
    {
        $product_id      = $this->request->getPost('product_id');
        $product_service = $this->request->getPost('product_service');

        if(is_numeric($product_id) && is_numeric($product_service))
        {
            $cart_data = $this->session->get('cart')['items'];
            if(!empty($cart_data))
            {
                $x = 0;

                foreach($cart_data as $cart_item)
                {
                    if($cart_item['product_id'] == $product_id && $cart_item['product_service'] == $product_service)
                    {
                        unset($cart_data[$x]);
                        break;
                    }

                    $x++;
                }
            
                $cart['cart']['items'] = $cart_data;
                $cart['cart']['total_items'] = count($cart_data);
                $this->session->set($cart);
            }


            $this->ShoppingCartModel
            ->where('user_id', userId())
            ->where('subscription_id', NULL)
            ->where('product_id', $product_id)
            ->where('product_service', $product_service);
            
            if($this->ShoppingCartModel->delete())
            {
                return $this->respondCreated(
                [
                    'status'    => 200,
                    'error'     => NULL,
                    'messages'  => lang('Site.success'),
                    'cart'      => count($cart_data),
                ]);
            }
        }

        return $this->fail(lang('Site.error'));
    }
}
