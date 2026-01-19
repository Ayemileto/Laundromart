<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\LocationsModel;
use App\Models\ShoppingCartModel;

class CheckoutController extends BaseController
{
    public function __construct()
    {
        $this->LocationsModel = new LocationsModel();
        $this->ShoppingCartModel =  new ShoppingCartModel();
    }

    public function cartData()
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

        return $this->ShoppingCartModel->get()->getResultArray();
    }

    public function index()
    {
        $cart_data = $this->cartData();
        if(empty($cart_data))
        {
            return redirect()->to(fullUrl(route_to('products')));
        }

        $data = [
            'view'              => 'checkout/products',
            'title'             => lang('Site.checkout'),
            'cart_data'         => $cart_data,
            'locations'         => $this->LocationsModel->where('status', 'active')->findAll(),
        ];

        echo view(frontLayout(), $data);
    }

    // public function completeProductsCheckout()
    public function save()
    {
        $cart_data = $this->cartData();
        $overall_total_price = 0;
        $data = [];

        foreach($cart_data as $cart)
        {
            $unit_price  = formatProductServicePriceCart($cart['price'], $cart['discount_price']);
            $total_price = $unit_price * $cart['quantity'];
            $overall_total_price += $total_price;

            $data['items'][] = [
                    'product_id'            => $cart['product_id'],
                    'product_service_id'    => $cart['product_service'],
                    'name'                  => $cart['name'].' ('.$cart['service_name'].')',
                    'quantity'              => $cart['quantity'],
                    'unit_price'            => $unit_price,
                    'total_price'           => $total_price,
            ];
        }

        if($this->request->getPost('pickup_type') == 'company')
        {
            $x = $this->request->getPost('zipcode');
            $x = json_decode($x, true);

            $location  = $this->LocationsModel
                        ->where('status', 'active')
                        ->where('id', $x['id'])
                        ->first();

            if(!empty($location))
            {
                if($this->request->getPost('shipping_type') == 'pickup_only')
                {
                    $shipping_type = 'pickup_only';
                    $type_text     = lang('Site.pickup_only');
                    $shipping_fee = $location['pickup_only_price'];
                }
                else if($this->request->getPost('shipping_type') == 'delivery_only')
                {
                    $shipping_type = 'delivery_only';
                    $type_text     = lang('Site.delivery_only');
                    $shipping_fee = $location['delivery_only_price'];
                }
                else
                {
                    $shipping_type = 'pickup_delivery';
                    $type_text     = lang('Site.pickup_delivery');
                    $shipping_fee = $location['pickup_delivery_price'];
                }

                $overall_total_price += $shipping_fee;

                $data['shipping'] = [
                    'firstname'         => $this->request->getPost('firstname'),
                    'lastname'          => $this->request->getPost('lastname'),
                    'location'          => $location['id'],
                    'address'           => $this->request->getPost('address'),
                    'address2'          => $this->request->getPost('address2'),
                    'pickup_date'       => $this->request->getPost('pickup_date'),
                    'pickup_time'       => $this->request->getPost('pickup_time'),
                    'delivery_date'     => $this->request->getPost('delivery_date'),
                    'delivery_time'     => $this->request->getPost('delivery_time'),
                    'shipping_type'     => $shipping_type,
                    'shipping_fee'      => $shipping_fee,
                    'item_name'         => lang('Site.shipping').' ('.$type_text.')',
                ];
            }
        }

        $invoiceController  = new \App\Controllers\InvoiceController();
        $invoice_id = $invoiceController->createInvoice($data, $overall_total_price, 'product');
        
        if(!is_numeric($invoice_id))
        {
            return redirect()->back()->with('alert-error', lang('Site.an_error_occured'));
        }
        $this->clearCart();
        
        return redirect()->to(fullUrl(route_to('user_route_view_invoice', $invoice_id)));        
    }


    public function checkDate($type)
    {
        if($type == 'pickup' && !empty($this->request->getPost("pickup_date"))
            && strtotime($this->request->getPost("pickup_date")) >= strtotime(date('Y-m-d'))
        )
        {
            $day    = strtolower(date("l", strtotime($this->request->getPost("pickup_date"))));
            $from   = getSetting('pickup_hours_'.$day.'_from');
            $to     = getSetting('pickup_hours_'.$day.'_to');
        }


        if($type == 'delivery' && !empty($this->request->getPost("delivery_date"))
            && strtotime($this->request->getPost("delivery_date")) >= strtotime(date('Y-m-d'))
        )
        {
            $day    = strtolower(date("l", strtotime($this->request->getPost("delivery_date"))));
            $from   = getSetting('delivery_hours_'.$day.'_from');
            $to     = getSetting('delivery_hours_'.$day.'_to');
        }

        if(!empty($from) && !empty($to))
        {
            return $this->respond([
                "status"        => 200,
                "is_valid"      => true,
                "min"           => $from,
                "max"           => $to,
            ]);
        }
        
        return $this->respond([
            "status"        => 200,
            "is_valid"      => false,
        ]);
    }

    public function zipCodes()
    {// Search zipcode in select2 dropdown
        $zipcodes = [];

        if(!empty($this->request->getGet('term')))
        {
            $term = trim($this->request->getGet('term'));

            $locations = $this->LocationsModel
                        ->where('status', 'active')
                        ->like('zipcode', $term)
                        ->orlike('name', $term)
                        ->findAll();
        
            foreach($locations as $location)
            {
                $zipcodes[] = [
                    "id"    => json_encode([
                                'id'                    => $location['id'],
                                'zipcode'               => $location['zipcode'],
                                'pickup_only_price'     => $location['pickup_only_price'],
                                'delivery_only_price'   => $location['delivery_only_price'],
                                'pickup_delivery_price' => $location['pickup_delivery_price'],
                            ]),
                    "text"  => $location['zipcode'].' || '.$location['name'],
                ];        
            }
        }
        
        return $this->respond([
            "results"   => $zipcodes
        ]);
    }
    
    public function clearCart()
    {
        unset($_SESSION['cart']);


        $ShoppingCartModel = new \App\Models\ShoppingCartModel();
        $ShoppingCartModel->where('user_id', userId());
        $ShoppingCartModel->where('subscription_id', NULL); 
        $ShoppingCartModel->delete();
        return;
    }
}