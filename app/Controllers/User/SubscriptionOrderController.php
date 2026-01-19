<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\SubscriptionModel;

class SubscriptionOrderController extends BaseController
{
    public function __construct()
    {
        $this->OrderModel           = new OrderModel();
        $this->ProductModel         = new ProductModel();
        $this->SubscriptionModel    = new SubscriptionModel();
    }

    public function verifySubscription($subscription_id)
    {
        $subscription = $this->SubscriptionModel
                        ->where('user_id', userId())
                        ->where('id', $subscription_id)
                        ->first();

        if(empty($subscription))
        {
            return lang('Site.selected_subscription_not_found');
        }

        if($subscription['status'] != 'expired' && $subscription['expiry_date'] <= date('Y-m-d H:i:s'))
        {
            $subscription['status'] = 'expired';
            $this->SubscriptionModel->set(['status' => 'expired'])->where('id', $subscription['id'])->update();
        }

        if($subscription['status'] != 'active' || $subscription['status'] == 'expired')
        {
            return lang('Site.selected_subscription_is_either_inactive_or_expired');
        }

        // VERIFY USER HAVEN'T SURPASSED ORDER FOR THIS SUBSCRIPTION MONTH
        if($subscription['orders_per_month'] == 0)
        { // UNLIMITED
            return true;
        }
        else
        {
            // GET THE ORIGINAL DATE USER SUBSCRIBED. For example 15th.
            $subscription_date = date('d', strtotime($subscription['subscription_date']));
    
            // GET THE ORIGINAL TIME USER SUBSCRIBED. For example 16:00.
            $subscription_time = date('H:i:s', strtotime($subscription['subscription_date']));
    
            $current_date = date('d'); // GET THE DATE OF TODAY. For example 20th.
            $current_time = date('H:i:s'); // GET THE CURRENT TIME. FOR example 12:00
    
            $current_month = date('m');
            $current_year = date('Y');
    
            /* IF CURRENT DATE IS GREATER THAN ORIGINAL SUBSCRIPTION DATE, THEN OUR SUBSCRIPTION MONTH STARTS THIS MONTH.
                OTHERWISE, IT STARTS LAST MONTH.
                
                For example, if current date is 20, and original subscription date is 15,
                20 > 15, so our subscription month will start from (15 of this month) and (end 15 of next month)
    
                if we flip that over and say, current date is 15 and original subscription date is 20,
                15 < 20, so our subscription month will start from (20 of last month) and end (20 of this month). 
    
                IN a situation where date is the same, we check for time
            */ 
            if($current_date > $subscription_date || ($current_date == $subscription_date && $current_time > $subscription_time))
            {
                // SUBSCRIPTION STARTED THIS MONTH AND ENDS NEXT MONTH.
                $start_date = "$current_year-$current_month-$subscription_date $subscription_time";
                $end_date   = date("Y-m-d H:i:s", strtotime($start_date."+1 MONTH"));
            }
            else
            {
                // SUBSCRIPTION STARTED LAST MONTH AND ENDS THIS MONTH.
                // IF CURRENT MONTH IS JANUARY, THEN OUR SUBSCRIPTION STARTED FROM DECEMBER LAST YEAR
                $start_month = $current_month == 1 ? 12 : $current_month - 1;
                $start_year = $current_month == 1 ? $current_year - 1 : $current_year;
    
    
                $start_date = "$start_year-$start_month-$subscription_date $subscription_time";
                $end_date   = date("Y-m-d H:i:s",  strtotime($start_date."+1 MONTH"));
            }
    
            $subscription_month_order = $this->OrderModel
                                        ->where('subscription_id', $subscription_id)
                                        ->where("created_at >= $start_date")
                                        ->where("created_at <= $end_date")->countAllResults();
    
            if($subscription['orders_per_month'] >= $subscription_month_order)
            {
                return redirect()->to(previousUrl())->with('alert-error', lang('Site.monthly_order_limit_reached'));
            }

            return true;
        }
    }

    public function create($subscription_id)
    {
        $verify_subscription = $this->verifySubscription($subscription_id);
        if($verify_subscription !== true)
        {
            return redirect()->to(previousUrl())->with('alert-error', $verify_subscription);
        }
        
        $data = [
            'view'              => 'user/subscription_order/create',
            'parent_nav'        => 'subscriptions',
            'current_nav'       => 'all_subscriptions',

            'title'             => lang('Site.create_order'),
            'meta_description'  => lang('Site.create_order'),
            'subscription_id'   => $subscription_id,
            'products'          => $this->ProductModel->where('status', 'active')->findAll()
 		];

        echo view(userLayout(), $data);
    }

    public function checkout($subscription_id)
    {
        $verify_subscription = $this->verifySubscription($subscription_id);
        if($verify_subscription !== true)
        {
            return redirect()->to(previousUrl())->with('alert-error', $verify_subscription);
        }
        
        $shoppingCartModel = new \App\Models\ShoppingCartModel();
        $subscription_cart = $shoppingCartModel->where('subscription_id', $subscription_id)->findAll();
        
        if(empty($subscription_cart))
        {
            return redirect()->to(previousUrl())->with('alert-error', lang('Site.cannot_checkout_empty_cart'));
        }

        $this->OrderModel->insert([
            'user_id'           => userId(),
            'subscription_id'   => $subscription_id,
            'status'            => 'active',
        ]);

        $order_id = $this->OrderModel->insertID();

        if(!empty($order_id))
        {
            $insert_data = [];

            foreach($subscription_cart as $item)
            {
                $insert_data[] = [
                    'user_id'               => userId(),
                    "order_id"              => $order_id,
                    "product_id"            => $item['product_id'],
                    "product_service_id"    => $item['product_service'],
                    "quantity"              => $item['quantity'],
                ];   
            }

            $OrderDetailsModel = new \App\Models\OrderDetailsModel();
            $OrderDetailsModel->insertBatch($insert_data);
        }

        $shoppingCartModel->where('subscription_id', $subscription_id)->delete();
        return redirect()->to(fullURL(route_to('user_route_orders', 'all')))
                ->with('alert-success', lang('Site.success'));
    }

}