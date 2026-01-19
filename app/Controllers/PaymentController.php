<?php namespace App\Controllers;
use App\ThirdParty\Personal\Mailer;
use App\Models\NotificationModel;
use App\Models\OrderModel;
use App\Models\PlanModel;
use App\Models\ProductModel;
use App\Models\ShoppingCartModel;
use App\Models\SubscriptionModel;
use App\Models\InvoiceModel;
use App\Models\PaymentGatewaysModel;

class PaymentController extends BaseController
{
    public function __construct()
    {
        $this->InvoiceModel = new InvoiceModel();
        $this->PaymentGatewaysModel = new PaymentGatewaysModel();
    }

    private function newGatewayInstance($payment_gateway)
    {
        $gateway = $this->PaymentGatewaysModel
                ->where('name', $payment_gateway)
                ->where('is_enabled', 'yes')
                ->first();
        
        if(!empty($gateway))
        {
            $gatewayInstance = '\App\Controllers\PaymentGateways\\'.ucfirst($gateway['name']).'Controller';
        }
        else
        {
            $gateway = $this->PaymentGatewaysModel->select('name')
            ->where('is_enabled', 'yes')
            ->where('is_default', 'yes')
            ->first();

            $gatewayInstance = '\App\Controllers\PaymentGateways\\'.ucfirst($gateway['name']).'Controller';
        }

        return new $gatewayInstance();
    }

    public function cancelledPayment($payment_gateway, $reference)
    {
        if(isLoggedIn())
        {
            $this->InvoiceModel->set(['status' => 'cancelled']);
            $this->InvoiceModel->where('reference', $reference);
            $this->InvoiceModel->where('user_id', userId());
            $this->InvoiceModel->where('status', 'pending');

            $this->InvoiceModel->update();
        }

        $this->newGatewayInstance($payment_gateway)->cancelledPayment($reference);
        
        return redirect()->to(fullUrl(route_to('payment_messages', 'cancelled')));
    }
    
    public function failedPayment($reference)
    {
        return redirect()->to(fullUrl(route_to('payment_messages', 'failed')));
    }

    public function initiatePayment($payment_gateway, $reference, $total_price, $tax, $total_due, array $data, array $user)
    {
        $payment_gateway = ucfirst(strtolower($payment_gateway));
        if($payment_gateway == 'Cash')
        {
            return redirect()->to(fullUrl(route_to('payment_messages', 'cash')));
        }

        return $this->newGatewayInstance($payment_gateway)->initiatePayment($reference, $total_price, $tax, $total_due, $data, $user);
        try {
        }
        catch(\Exception $e)
        {
            return redirect()->to(previousUrl())->with('alert-error', lang('Site.unable_to_initiate_payment'));
        }
    }

    public function processWebHook($payment_gateway)
    {
        $this->newGatewayInstance($payment_gateway)->processWebHook();
    }

    public function successfulPayment($payment_gateway)
    {
        $payment_gateway = ucfirst(strtolower($payment_gateway));

        try {
            $status = $this->newGatewayInstance($payment_gateway)->successfulPayment();
        }
        catch(\Exception $e)
        {
            $status = 'unknown';
        }

        return redirect()->to(fullUrl(route_to('payment_messages', $status)));
    }

    public function messages($status)
    {
        if(!in_array($status, ['cash', 'success', 'processing', 'failed', 'unknown', 'cancelled']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $data = [
            'title'                 => lang('Site.payment_status'),
            'view'                  => 'pages/payment_messages',
            'status'                => $status,
        ];

        return view(frontLayout(), $data);
    }
}