<?php namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\OrderModel;
use App\Models\OrderShippingsModel;
use App\Models\PlanModel;
use App\Models\ProductModel;
use App\Models\ShoppingCartModel;
use App\Models\SubscriptionModel;
use App\Models\VisitorsModel;

class DashboardController extends BaseController
{
    private $InvoiceModel;
    private $OrderModel;
    private $OrderShippingsModel;
    private $PlanModel;
    private $ProductModel;
    private $SubscriptionModel;
    private $VisitorsModel;
    
    public function __construct()
    {
        $this->InvoiceModel         = new InvoiceModel();
        $this->OrderModel           = new OrderModel();
        $this->OrderShippingsModel  = new OrderShippingsModel();
        $this->PlanModel            = new PlanModel();
        $this->ProductModel         = new ProductModel();
        $this->SubscriptionModel    = new SubscriptionModel();
        $this->VisitorsModel        = new VisitorsModel();
    }

    public function index()
    {
        $data = [
            "view"                   => "admin/dashboard",
            "title"                  => "Admin Dashboard",
            "meta_description"       => "Admin Dashboard",
        ];

        if(has_permission('view_order'))
        {
            $data['active_orders']          = $this->OrderModel->where('status', 'active')->countAllResults();
            $data['active_orders_value']    = $this->InvoiceModel->selectSum('total_due')
                                        ->where("id IN (SELECT invoice_id FROM orders WHERE status='active' and deleted_at is NULL)")
                                        ->first()['total_due'] ?? 0;
            $data['pending_orders']         = $this->OrderModel->where('status', 'pending')->countAllResults();
            $data['pending_orders_value']   = $this->InvoiceModel->selectSum('total_due')
                                        ->where("id IN (SELECT invoice_id FROM orders WHERE status='pending' and deleted_at is NULL)")
                                        ->first()['total_due'] ?? 0;
            $data['latest_orders']          = $this->OrderModel->select('orders.*, users.username,
                                                invoices.total_due, invoices.status as payment_status')
                                                ->limit(5)->orderBy("id", "DESC")
                                                ->join('users', 'users.id=orders.user_id', 'left')
                                                ->join('invoices', 'invoices.id=orders.invoice_id', 'left')
                                                ->get()->getResultArray();
        }

        if(has_permission('view_subscription'))
        {
            $data['active_subscriptions']          = $this->SubscriptionModel
                                                    ->where('status', 'active')
                                                    ->countAllResults();
            $data['active_subscriptions_value']    =  $this->InvoiceModel->selectSum('total_due')
                                                ->where("id IN (SELECT invoice_id FROM subscriptions WHERE status='active' and deleted_at is NULL)")
                                                ->first()['total_due'] ?? 0;
            $data['pending_subscriptions']         = $this->SubscriptionModel
                                                    ->where('status', 'pending')
                                                    ->countAllResults();
            $data['pending_subscriptions_value']   =  $this->InvoiceModel->selectSum('total_due')
                                                ->where("id IN (SELECT invoice_id FROM subscriptions WHERE status='pending' and deleted_at is NULL)")
                                                ->first()['total_due'] ?? 0;
        
            $data['expiring_subscriptions']        = $this->SubscriptionModel
                                                    ->where('status', 'active')
                                                    ->where('expiry_date <= NOW() + INTERVAL 2 DAY')
                                                    ->countAllResults();
            $data['expiring_subscriptions_value']  =   $this->InvoiceModel->selectSum('total_due')
                                                ->where("id IN (SELECT invoice_id FROM subscriptions
                                                WHERE expiry_date <= NOW() + INTERVAL 2 DAY and deleted_at is NULL)")
                                                ->first()['total_due'] ?? 0;
            
            $data['latest_subscriptions']           = $this->SubscriptionModel->select(
                                        'subscriptions.*, users.username, plans.name as plan_name,
                                        invoices.total_due, invoices.status as payment_status')
                                        ->limit(5)->orderBy("id", "DESC")
                                        ->join('users', 'users.id=subscriptions.user_id', 'left')
                                        ->join('plans', 'plans.id=subscriptions.plan_id', 'left')
                                        ->join('invoices', 'invoices.id=subscriptions.invoice_id', 'left')
                                        ->get()->getResultArray();
        }

        if(has_permission('view_shipping'))
        {
            $data['pending_pickups']    = $this->OrderShippingsModel->where('pickup_status', 'pending')
                                                    ->where('shipping_type', 'pickup_only')
                                                    ->orwhere('shipping_type', 'pickup_delivery')
                                                    ->countAllResults();
            $data['pending_deliveries'] = $this->OrderShippingsModel->where('delivery_status', 'pending')
                                                    ->where('shipping_type', 'delivery_only')
                                                    ->orwhere('shipping_type', 'pickup_delivery')
                                                    ->countAllResults();
        }
        
        if(has_permission('view_product'))
        {
            $data['latest_products']    = $this->ProductModel->select("products.*,
                                        (SELECT CONCAT(MIN(psp.price),';;',MAX(psp.price),';;',
                                        MIN(psp.discount_price),';;',MAX(psp.discount_price))
                                        FROM products_services_prices psp WHERE psp.product_id = products.id)
                                        as prices")->limit(5)->orderBy("id", "DESC")
                                        ->get()->getResultArray();
        }

        if(has_permission('view_statistic'))
        {
            $data['todays_visitors']       = $this->VisitorsModel->where('date', date("Y-m-d"))->first()['total_visitors'] ?? 0;
        }

        echo view(adminLayout(), $data);
    }
}