<?php namespace App\Controllers\PaymentGateways;
use App\Controllers\BaseController;
use App\Controllers\InvoiceController;
use App\Models\InvoiceModel;
use App\Models\PaymentGatewaysModel;

class FlutterwaveController extends BaseController
{
    private $curl;
    private $flutterwaveData;

    public function __construct()
    {
        $this->InvoiceController = new InvoiceController();
        $this->InvoiceModel = new InvoiceModel();
        $this->PaymentGatewaysModel = new PaymentGatewaysModel();

        $this->flutterwaveData = $this->PaymentGatewaysModel
                                ->where('name', 'Flutterwave')
                                ->first();


        $this->curl = $this->curlSetup();
    }

    public function curlSetup()
    {
        $options = [
            'base_uri'    => 'https://api.flutterwave.com/v3/',
            'verify'      => true,
            'http_errors' => false,
            'headers'     => [
                    'Authorization' => 'Bearer '.$this->flutterwaveData['secret_key'],
                    'Cache-Control' => 'no-cache',
            ]
        ];

        return \Config\Services::curlrequest($options);
    }

    public function cancelledPayment($invoice_reference)
    {

    }

    public function failedPayment($invoice_reference)
    {

    }

    public function initiatePayment($invoice_reference, $total_price, $tax, $total_due, $data, $user)
    {
        helper('text');
        $transaction_ref    =  'FLW_'.random_string('alnum', 16);
        
        $response = $this->curl->request('post', 'payments',
                        [
                            'json'  =>
                            [
                                'tx_ref'            => $transaction_ref,
                                'amount'            => $total_due,
                                'currency'          => $this->flutterwaveData['currency'],
                                "payment_options"   => array_map('trim', explode(',', $this->flutterwaveData['payment_options'])),

                                'meta'      => [
                                    'invoice_reference' => $invoice_reference,
                                    'user_id'           => $user['id'],
                                ],

                                "customer"  =>  [
                                    'email'     => $user['email'],
                                    "name"      => $user['firstname'].' '.$user['lastname'],
                                ],
                                
                                "customizations" => [
                                    "title"         => siteName(),
                                    "description"   => getSetting('site_title'),
                                    "logo"          => logo()
                                ],
                                'redirect_url'  => fullUrl(route_to('payment_success_url', 'flutterwave')),
                            ]
                        ]
                    );

        if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
        {
            $response = json_decode($response->getBody());

            if($response->status == "success")
            {
                return redirect()->to($response->data->link);
            }
        }

        return redirect()->to(previousUrl())->with('alert-error', lang('Site.unable_to_initiate_payment'));
    }

    public function processWebHook()
    {

    }

    public function successfulPayment()
    {
        $transaction_id = $_GET['transaction_id'];

        if(!empty($transaction_id))
        {
            $response = $this->curl->request('GET', "transactions/$transaction_id/verify");

            if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
            {
                $response = json_decode($response->getBody());

                if($response->status == "success")
                {
                    if($response->data->status == 'successful')
                    {
                        $amountPaid = $response->data->amount/100;
                        $currency   = $response->data->currency;
                        $invoice_reference = $response->data->meta->invoice_reference;
                        
                        
                        $this->InvoiceController->markInvoiceAsPaid(
                                                    $invoice_reference,
                                                    $amountPaid,
                                                    "Flutterwave",
                                                    $response->data->tx_ref
                                                );

                        return "success";
                    }
                }
            }
        }

        return "failed";
    }
}