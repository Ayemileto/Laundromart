<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use App\Models\SubscriptionModel;
use App\Models\VisitorsModel;

class AnalyticsController extends BaseController
{
    public function __construct()
    {
        $this->OrderModel           =  new OrderModel();
        $this->OrderDetailsModel    =  new OrderDetailsModel();
        $this->SubscriptionModel    = new SubscriptionModel();
        $this->VisitorsModel        = new VisitorsModel();
    }

	public function index()
	{
		//
    }
    
    public function analytics($type)
    {
        $type = strtolower($type);

        if(!in_array($type, ['sales', 'visitors']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }


        $data = [
            'view'              => 'admin/analytics/'.$type,
            "parent_nav"        => 'analytics',
            "current_nav"       => $type,

            'title'             => lang('Site.'.$type),
            'meta_description'  => lang('Site.'.$type),
        ];

        echo view(adminLayout(), $data);
    }

    
    public function sales()
    {
        $this->OrderModel->select('MONTH(orders.completed_at) as month, SUM(invoices.total_price) as total_price')
                    ->where('orders.status', 'completed')
                    ->where('YEAR(orders.completed_at) = YEAR(CURDATE())');
                    
        $this->OrderModel->join('invoices', 'invoices.id = orders.invoice_id', 'left');

        $product_sales = $this->OrderModel->groupBy('MONTH(orders.completed_at)')->findAll();
        $product_sales = array_column($product_sales, 'total_price', 'month');
        $product_months = array_keys($product_sales);

        $this->SubscriptionModel->select('MONTH(subscriptions.subscription_date)
                             as month, SUM(invoices.total_price) as total_price')
                            ->where('YEAR(subscriptions.subscription_date) = YEAR(CURDATE())');
        
        $this->SubscriptionModel->where('subscriptions.status', 'active')
                            ->orwhere('subscriptions.status', 'expired');

        $this->SubscriptionModel->join('invoices', 'invoices.id = subscriptions.invoice_id', 'left');
        $subscription_sales = $this->SubscriptionModel->groupBy('month')->findAll();


        $subscription_sales = array_column($subscription_sales, 'total_price', 'month');
        $subscription_months = array_keys($subscription_sales);

        $product_data = $subscription_data = $data = [];
        $this_year_sales = 0;
        $since_last_year = 0;

        for($i = 1; $i <= 12; $i++)
        {
            $product_month_total = in_array($i, $product_months) ? $product_sales[$i] : 0;
            $product_data[] = $product_month_total;

            $subscription_month_total = in_array($i, $subscription_months) ? $subscription_sales[$i] : 0;
            $subscription_data[] = $subscription_month_total;

            $month_total = $product_month_total + $subscription_month_total;
            $data[] = $month_total;
            $this_year_sales += $month_total;
            
            if($i == date('m'))
            {
                if($i == 1)
                {// JANUARY OF A NEW YEAR.
                    // FETCH DATA FOR DECEMBER LAST YEAR

                    $this->OrderModel->select('SUM(invoices.total_price) as total_price')
                    ->where('orders.status', 'completed')
                    ->where('YEAR(orders.completed_at) = YEAR(CURDATE()) - 1')
                    ->where('MONTH(orders.completed_at) = 12');
                    
                    $this->OrderModel->join('invoices', 'invoices.id = orders.invoice_id', 'left');

                    $last_december_product_sales = $this->OrderModel->first()['total_price'] ?? 0;

                    
                    $this->SubscriptionModel->select('SUM(invoices.total_price) as total_price')
                    ->where('YEAR(subscriptions.subscription_date) = YEAR(CURDATE()) - 1')
                    ->where('MONTH(subscriptions.subscription_date) = 12')
                    ->where('subscriptions.status', 'active')
                    ->orwhere('subscriptions.status', 'expired');
                    
                    $this->SubscriptionModel->join('invoices', 'invoices.id = subscriptions.invoice_id', 'left');
                    $last_december_subscription_sales = $this->SubscriptionModel->first()['total_price'] ?? 0;

                    $last_month_sales = $last_december_product_sales + $last_december_subscription_sales;

                }
                else
                {    
                    // ARRAY INDEX STARTS FROM 0, while $i represents he current month (from 1 -12)
                    // $data[$i - 1] gives us current month. for example
                    // $data[1 - 1] = $data[0] = january
                    // $data[2 - 1] = $data[1] = february
                    // Therefor to get previous month, we use -2

                    $last_month_sales = $data[$i-2];
                }
                
                $this_month_sales = $data[$i-1];    
                
                //CALCULATE SALES PERCENTAGE CHANGE SINCE LAST MONTH
                $since_last_month = $last_month_sales == 0 ? 
                                        $this_month_sales * 100 :
                                        (($this_month_sales - $last_month_sales)
                                        / $last_month_sales) * 100;
            }
        }

        return $this->respond([
            "status"            => 200,
            "error"             => null,
            "product_sales"       => $product_data,
            "subscription_sales"  => $subscription_data,
            "this_year_sales"   => $this_year_sales,
            "since_last_month"  => $since_last_month
        ]);
    }

    public function salesByProducts()
    {
        $sales = $this->OrderDetailsModel
                    ->select('products.name as product_name,
                             SUM(quantity) as product_quantity,
                             '
                            )
                    ->join('products', 'products.id = order_details.product_id')
                    ->where('order_id IN (SELECT id FROM orders WHERE 
                             completed_at >= NOW() - INTERVAL 30 DAY)')
                    ->groupBY('product_id')
                    ->orderBy('product_quantity DESC')
                    ->findAll();


        $labels = $data = [];
        
        // IF THE DIFFERENT PRODUCT SOLD ARE MORE THAN 5, TAKE THE TOP 5. OTHERWISE, TAKE ALL.
        for($i= 0; $i < (count($sales) > 5 ? 5 : count($sales)) ; $i++)
        {
            $labels[] = $sales[$i]['product_name'];
            $data[]   = (int) $sales[$i]['product_quantity'];
        }

        // IF WE TOOK TOP 5, SUM UP THE REMAINING AS "OTHERS" 
        if(count($sales) > 5)
        {
            $others = 0;
            
            for($i = 5; $i < count($sales); $i++)
            {
                $others += $sales[$i]['product_quantity'];
            }

            $labels[] = "Others";
            $data[]   = $others;
        }

        return $this->respond([
            "status"    => 200,
            "error"     => null,
            "labels"    => $labels,
            "sales"     => $data,
        ]);
    }


    public function SubscriptionsByPlans()
    {
        $sales = $this->SubscriptionModel
                    ->select('plans.name as plan_name,
                             COUNT(subscriptions.id) as subscription_quantity')
                    ->join('plans', 'plans.id = subscriptions.plan_id')
                    ->where('subscriptions.subscription_date >= NOW() - INTERVAL 30 DAY')
                    ->groupBY('plan_id')
                    ->orderBy('subscription_quantity DESC')
                    ->findAll();


        $labels = $data = [];
        
        // IF THE DIFFERENT PRODUCT SOLD ARE MORE THAN 5, TAKE THE TOP 5. OTHERWISE, TAKE ALL.
        for($i= 0; $i < (count($sales) > 5 ? 5 : count($sales)) ; $i++)
        {
            $labels[] = $sales[$i]['plan_name'];
            $data[]   = (int) $sales[$i]['subscription_quantity'];
        }

        // IF WE TOOK TOP 5, SUM UP THE REMAINING AS "OTHERS" 
        if(count($sales) > 5)
        {
            $others = 0;
            
            for($i = 5; $i < count($sales); $i++)
            {
                $others += $sales[$i]['subscription_quantity'];
            }

            $labels[] = "Others";
            $data[]   = $others;
        }

        return $this->respond([
            "status"    => 200,
            "error"     => null,
            "labels"    => $labels,
            "sales"     => $data,
        ]);
    }

    public function visitors()
    {
        $last_week_array = $this_week_array = [];

        $visitors    = $this->VisitorsModel->limit(14)->orderBy("id", "DESC")->findAll();
        $visitors    = array_column($visitors, "total_visitors", "date"); 
        $visit_dates = array_keys($visitors);

        for ($i= 0; $i < 14; $i++)
        {
            $date = date("Y-m-d", strtotime("$i days ago"));
            $day = date("D", strtotime($date));

            if($i < 7)
            {
                if(in_array($date, $visit_dates))
                {
                    $this_week_array[$day] = $visitors[$date];
                }
                else
                {
                    $this_week_array[$day] = 0;
                }                
            }
            else
            {
                if(in_array($date, $visit_dates))
                {
                    $last_week_array[$day] = $visitors[$date];
                }
                else
                {
                    $last_week_array[$day] = 0;
                }
            }
        }

        $this_week_total = array_sum(array_values($this_week_array));
        $last_week_total = array_sum(array_values($last_week_array));
        
        //TO AVOID DIVISION BY ZERO ERROR
        $percent_change = $last_week_total == 0 ? $this_week_total * 100 :
                (($this_week_total - $last_week_total) / $last_week_total ) * 100;

        $total_visitors = $this->VisitorsModel->selectSum("total_visitors")->first()["total_visitors"];
        return $this->respond([
                "status"           => 200,
                "error"            => null,
                "this_week"        => array_reverse($this_week_array),
                "last_week"        => array_reverse($last_week_array),
                "percent_change"   => number_format($percent_change, 2),
                "all_time"         => $total_visitors,
            ]);
    }
}
