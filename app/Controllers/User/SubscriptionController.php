<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\SubscriptionModel;

class SubscriptionController extends BaseController
{
    public function __construct()
    {
        $this->SubscriptionModel = new SubscriptionModel();
    }

    public function index($status)
    {
        $status = strtolower($status);
        $title = $current_nav = $status.'_subscriptions';

        if(!in_array($status, ['all', 'active', 'expired', 'expiring']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
        $this->SubscriptionModel
            ->select('subscriptions.*, plans.name as plan_name,
                invoices.total_due, invoices.status as payment_status,
                (SELECT COUNT(id) FROM orders WHERE subscriptions.id =
                 orders.subscription_id) as total_orders')
            ->where('subscriptions.user_id', userId());
  

        if(in_array($status, ['active', 'expired']))
        {
            $this->SubscriptionModel->where('subscriptions.status', $status);
        }

        if($status == 'expiring')
        {
            $this->SubscriptionModel->where('subscriptions.expiry_date <= NOW() + INTERVAL 48 HOUR');
        }

        $this->SubscriptionModel->join('plans', 'plans.id = subscriptions.plan_id', 'left')
        ->join('invoices', 'invoices.id = subscriptions.invoice_id', 'left')
        ->orderBy('subscriptions.id', 'DESC');
            
        $data = [
            'view'              => 'user/subscription/index',
            'parent_nav'        => 'subscriptions',
            'current_nav'       => $current_nav ?? 'subscriptions',

            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'subscriptions'     => $this->SubscriptionModel->paginate(6),
            'pager'             => $this->SubscriptionModel->pager
		];

        echo view(userLayout(), $data);
    }

    public function view($id)
    {
        $subscription = $this->SubscriptionModel
                                    ->select('subscriptions.*, 
                                             plans.name as plan_name')
                                    ->where('user_id', userId())
                                    ->join('plans', 'plans.id = subscriptions.plan_id', 'left')
                                    ->where('subscriptions.id', $id)->first();

        if(empty($subscription))
        {
            show_404();
        }

        $data = [
            'title'             => lang('Site.subscription_details'),
            'meta_description'  => lang('Site.subscription_details'),
            'subscription'      => $subscription,
        ];

        echo view(userTheme(). '/user/subscription/view', $data);
    }

    public function subscribe($plan_id)
    {
        $planModel = new \App\Models\PlanModel();
        $planModel->where('status', 'active');
        $planModel->where('id', $plan_id);
        $plan = $planModel->first();

        if(empty($plan))
        {
            return redirect()->to(previousUrl())->with('alert-error', lang('Site.plan_not_found'));
        }

        if(isset($_GET['period']) && in_array($_GET['period'], ['monthly', 'quarterly', 'semi-annually', 'yearly']))
        {
            
            switch ($_GET['period']) {

                case 'quarterly':
                    $period = lang('Site.quarter');
                    $price = $plan['quarterly_price'];
                break;

                case 'semi-annually':
                    $period = lang('Site.semi_annual');
                    $price = $plan['semi_annually_price'];
                break;

                case 'yearly':
                    $period = '1 '.lang('Site.year');
                    $price = $plan['yearly_price'];
                break;
                
                default:
                    $period = '1 '.lang('Site.month');
                    $price = $plan['monthly_price'];
                break;
            }
        }
        else
        {
            $period = '1 '.lang('Site.month');
            $price = $plan['monthly_price'];
        }

        $data = [
            'view'              => 'checkout/subscribe',
            'title'             => lang('Site.confirm_subscription'),
            'plan'              => $plan,
            'period'            => $period,
            'price'             => $price,
        ];

        echo view(frontLayout(), $data);
    }

    public function do_subscribe($plan_id)
    {
        $planModel = new \App\Models\PlanModel();
        $planModel->where('status', 'active');
        $planModel->where('id', $plan_id);
        $plan = $planModel->first();

        if(empty($plan))
        {
            return redirect()->back()->with('alert-error', lang('Site.plan_not_found'));
        }

        if(isset($_GET['period']) && in_array($_GET['period'], ['monthly', 'quarterly', 'semi-annually', 'yearly']))
        {
            
            switch ($_GET['period']) {

                case 'quarterly':
                    $duration = '3 MONTHS';
                    $price = $plan['quarterly_price'];
                break;

                case 'semi-annually':
                    $duration = '6 MONTHS';
                    $price = $plan['semi_annually_price'];
                break;

                case 'yearly':
                    $duration = '1 YEAR';
                    $price = $plan['yearly_price'];
                break;
                
                default:
                    $duration = '1 MONTH';
                    $price = $plan['monthly_price'];
                break;
            }
        }
        else
        {
            $duration = '1 MONTH';
            $price = $plan['monthly_price'];
        }

        $data['subscription'] = [
                        'name'          => $plan['name'],
                        'plan_id'       => $plan['id'],
                        'duration'      => $duration,
                        'unit_price'    => $price,
                        'total_price'   => $price,
                        'is_renewal'    => false, //(TRUE FOR RENEWAL)
                        'previous_id'   => NULL, // WILL HAVE A NUMBER FOR RENEWAL
                    ];

        $invoiceController  = new \App\Controllers\InvoiceController();
        $invoice_id = $invoiceController->createInvoice($data, $price, 'subscription');

        if(!is_numeric($invoice_id))
        {
            return redirect()->to(previousUrl())->with('alert-error', lang('Site.an_error_occured'));
        }
                
        return redirect()->to(fullUrl(route_to('user_route_view_invoice', $invoice_id)));
    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }
}