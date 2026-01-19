<?php namespace App\Controllers\Admin;

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

        if(in_array($status, ['active', 'expired']))
        {
            $this->SubscriptionModel->where('subscriptions.status', $status);
        }

        if($status == 'expiring')
        {
            $this->SubscriptionModel->where('subscriptions.expiry_date <= NOW() + INTERVAL 48 HOUR');
        }

        $data = [
            'view'              => 'admin/subscription/index',
            "parent_nav"        => "subscriptions",
            "current_nav"       => $current_nav ?? "subscriptions",

            'title'             => lang('Site.'.$title),
            'meta_description'  => lang('Site.'.$title),
            'subscriptions'     => $this->SubscriptionModel
                                    ->select('subscriptions.*, plans.name as plan_name,
                                     concat(users.firstname," ",users.lastname) as subscriber_name,
                                     invoices.total_due, invoices.status as payment_status')
                                    ->join('plans', 'plans.id = subscriptions.plan_id', 'left')
                                    ->join('users', 'users.id = subscriptions.user_id', 'left')
                                    ->join('invoices', 'invoices.id = subscriptions.invoice_id', 'left')
                                    ->orderBy('subscriptions.id', 'DESC')
                                    ->paginate(500),
            'pager'             => $this->SubscriptionModel->pager
		];

        echo view(adminLayout(), $data);
    }

    public function view($id)
    {
        $data = [
            'title'             => lang('Site.subscription_details'),
            'meta_description'  => lang('Site.subscription_details'),
            'subscription'      => $this->SubscriptionModel
                                    ->select('subscriptions.*, 
                                             plans.name as plan_name, 
                                             concat(users.firstname," ",users.lastname) as subscriber_name,
                                             users.email, users.phone, users.avatar
                                            ')
                                    ->join('plans', 'plans.id = subscriptions.plan_id')
                                    ->join('users', 'users.id = subscriptions.user_id')
                                    ->where('subscriptions.id', $id)->first(),
        ];

        echo view(adminTheme().'/admin/subscription/view', $data);
    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }
}