<?php namespace App\Controllers\User;
use App\Controllers\BaseController;
use App\Models\NotificationModel;
use App\Models\InvoiceModel;
use App\Models\OrderModel;
use App\Models\OrderShippingsModel;
use App\Models\PlanModel;
use App\Models\ProductModel;
use App\Models\ShoppingCartModel;
use App\Models\SubscriptionModel;

class DashboardController extends BaseController
{
    private $InvoiceModel;
    private $OrderModel;
    private $OrderShippingsModel;
    private $PlanModel;
    private $ProductModel;
    private $SubscriptionModel;
    
    public function __construct()
    {
        $this->InvoiceModel         = new InvoiceModel();
        $this->OrderModel           = new OrderModel();
        $this->OrderShippingsModel  = new OrderShippingsModel();
        $this->PlanModel            = new PlanModel();
        $this->ProductModel         = new ProductModel();
        $this->SubscriptionModel    = new SubscriptionModel();
    }

    public function index()
    {
        $user_id = userId();
        $data = [
            "view"                      => "user/dashboard",
            "title"                     => "User Dashboard",
            "meta_description"          => "User Dashboard",

            "active_orders"             => $this->OrderModel->where("user_id", userId())->where("status", "active")->countAllResults(),
            'active_orders_value'       => $this->InvoiceModel->selectSum('total_due')
                                            ->where("id IN (SELECT invoice_id FROM orders WHERE status='active' and user_id='$user_id' and deleted_at is NULL)")
                                            ->first()['total_due'] ?? 0,
            "pending_orders"            => $this->OrderModel->where("user_id", userId())->where("status", "pending")->countAllResults(),
            'pending_orders_value'      => $this->InvoiceModel->selectSum('total_due')
                                            ->where("id IN (SELECT invoice_id FROM orders WHERE status='pending' and user_id='$user_id' and deleted_at is NULL)")
                                            ->first()['total_due'] ?? 0,
                                            
                                            
            "active_subscriptions"          => $this->SubscriptionModel->where("user_id", userId())->where("status", "active")->countAllResults(),
            'active_subscriptions_value'    => $this->InvoiceModel->selectSum('total_due')
                                                ->where("id IN (SELECT invoice_id FROM subscriptions WHERE status='active' and user_id='$user_id' and deleted_at is NULL)")
                                                ->first()['total_due'] ?? 0,
            'expiring_subscriptions'        => $this->SubscriptionModel
                                                ->where("user_id", userId())
                                                ->where('status', 'active')
                                                ->where('expiry_date <= NOW() + INTERVAL 2 DAY')
                                                ->countAllResults(),
            'expiring_subscriptions_value'  =>  $this->InvoiceModel->selectSum('total_due')
                                                ->where("id IN (SELECT invoice_id FROM subscriptions
                                                WHERE expiry_date <= NOW() + INTERVAL 2 DAY and user_id='$user_id' and deleted_at is NULL)")
                                                ->first()['total_due'] ?? 0,

            "latest_orders"          => $this->OrderModel->select('orders.*,
                                        invoices.total_due, invoices.status as payment_status')
                                        ->limit(5)->orderBy("id", "DESC")
                                        ->where("orders.user_id", userId())
                                        ->join('invoices', 'invoices.id=orders.invoice_id', 'left')
                                        ->get()->getResultArray(),
            "latest_subscriptions"   => $this->SubscriptionModel->select(
                                        'subscriptions.*, plans.name as plan_name,
                                        invoices.total_due, invoices.status as payment_status')
                                        ->limit(5)->orderBy("id", "DESC")
                                        ->where("subscriptions.user_id", userId())
                                        ->join('plans', 'plans.id=subscriptions.plan_id', 'left')
                                        ->join('invoices', 'invoices.id=subscriptions.invoice_id', 'left')
                                        ->get()->getResultArray(),

            "latest_invoices"           => $this->InvoiceModel->where("user_id", userId())
                                            ->limit(5)->orderBy("id", "DESC")
                                            ->get()->getResultArray(),

            'pending_pickups_or_delivery' => $this->OrderShippingsModel
                                            ->where("user_id", userId())
                                            ->where('pickup_status', 'pending')
                                            ->orwhere('delivery_status', 'pending')
                                            ->countAllResults(),
        ];
        
        echo view(userLayout(), $data);
    }
}