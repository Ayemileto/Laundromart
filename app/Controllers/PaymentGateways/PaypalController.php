<?php namespace App\Controllers\PaymentGateways;
use App\Controllers\BaseController;
use App\Controllers\InvoiceController;
use App\Models\InvoiceModel;
use App\Models\PaymentGatewaysModel;

class PaypalController extends BaseController
{
    private $PaypalData;

    public function __construct()
    {
        $this->InvoiceController = new InvoiceController();
        $this->InvoiceModel = new InvoiceModel();
        $this->PaymentGatewaysModel = new PaymentGatewaysModel();

        $this->PaypalData = $this->PaymentGatewaysModel
                                ->where('name', 'Paypal')
                                ->first();        
        

        $this->curl = $this->curlSetup();
    }

    public function curlSetup()
    {
        $options = [
            'base_uri'    => 'https://api-m.paypal.com/',
            'verify'      => true,
            'http_errors' => false,
            'headers'     => [
                    'Authorization' => 'Basic '.base64_encode($this->PaypalData['public_key'].':'.$this->PaypalData['secret_key']),
                    'Cache-Control' => 'no-cache',
                    'Content-Type'  => 'application/json',
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
        $items = [];

        // PRODUCTS ADDED TO CART
        if(!empty($data['items']))
        {
            foreach($data['items'] as $d)
            {
                $items[] = [
                    'name'          => $d['name'],
                    'unit_amount'   => [
                                        "currency_code" => $this->PaypalData['currency'],
                                        "value" => $d['unit_price'],
                                    ],
                    'quantity'      => $d['quantity'] ?? 1,
                ];
            }
        }

        // CUSTOM ITEMS ADDED BY ADMIN
        if(!empty($data['custom_items']))
        {
            foreach($data['custom_items'] as $d)
            {
                $items[] = [
                    'name'          => $d['name'],
                    'unit_amount'   => [
                                        "currency_code" => $this->PaypalData['currency'],
                                        "value" => $d['price'],
                                    ],
                    'quantity'      => $d['quantity'] ?? 1,
                ];
            } 
        }

        // SHIPPING DETAILS
        if(!empty($data['shipping']))
        {
            $items[] = [
                'name'          => $data['shipping']['item_name'],
                'unit_amount'   => [
                                    "currency_code" => $this->PaypalData['currency'],
                                    "value" => $data['shipping']['shipping_fee'],
                                ],
                'quantity'      => 1,
            ];
        }
        
        // SUBSCRIPTION PLANS
        if(!empty($data['subscription']))
        {
            $items[] = [
                'name'          => $data['subscription']['name'].' ('.$data['subscription']['duration'].')',
                'unit_amount'   => [
                                    "currency_code" => $this->PaypalData['currency'],
                                    "value" => $data['subscription']['total_price'],
                                ],
                'quantity'      => 1,
            ];
        }

        if(!empty($tax))
        {
            $items[] = [
                'name'          => 'tax',
                'unit_amount'   => [
                                    "currency_code" => $this->PaypalData['currency'],
                                    "value"         => $tax,
                                ],

                'quantity'      => 1,
            ];
        }
        $purchase_units[] =   [
                                "amount" => [
                                    "currency_code" => $this->PaypalData['currency'],
                                    "value" => $total_due,
                                        "breakdown"  => [
                                            "item_total"    => [
                                                        "currency_code" => $this->PaypalData['currency'],
                                                        "value" => $total_due,
                                                    ],
                                                ]
                                            ],

                                "items"         => $items,
                                "invoice_id"    => $invoice_reference,
                            ];

        $response = $this->curl->request('post', 'v2/checkout/orders',
                        [
                            'json'  =>
                            [
                                "intent"                => "CAPTURE",
                                "purchase_units"        => $purchase_units,
                                "payer"                 => [
                                                            'email_address' => $user['email'],
                                                            'name'          => [
                                                                    'given_name'    => $user['firstname'],
                                                                    'surname'       => $user['lastname'],
                                                            ],
                                                        ],
                                "application_context"   => [
                                                            "brand_name"    => siteName(),
                                                            "return_url"    => fullUrl(route_to('payment_success_url', 'paypal')),
                                                            "cancel_url"    => fullUrl(route_to('payment_cancel_url', 'paypal', $invoice_reference)),
                                                        ]
                            ]
                        ]
                    );

        if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
        {
            $response = json_decode($response->getBody());
            if(strtoupper($response->status) == "CREATED")
            {
                return redirect()->to($response->links[1]->href);
            }
        }

        return redirect()->to(previousUrl())->with('alert-error', lang('Site.unable_to_initiate_payment'));
    }

    public function processWebHook()
    {
        $headers  = getallheaders(); //GET ALL HTTP HEADERS SENT WITH THE REQUEST
        $body     = file_get_contents('php://input'); // GET THE WEBHOOK DATA

        $body     = json_decode($body, true);


        if($this->verifyWebhookData($headers, $body))
        {
            // THE PAYMENT WAS APPROVED, CAPTURE IT.
            if(strtoupper($body['event_type']) === 'CHECKOUT.ORDER.APPROVED' && strtoupper($body['resource']['status']) === 'APPROVED')
            {
                foreach($body['resource']['links'] as $link)
                {
                    if(strtolower($link['rel'] === 'capture'))
                    {
                        $capture_link =  $link['href'];
                        break;
                    }
                }
                
                if(!empty($capture_link))
                {
                    // WE ARE REMOVING THE STRING CAUSE WE ALREADY SET IT IN BASE URL ABOVE
                    $capture_link = str_replace('https://api-m.paypal.com/', '', $capture_link);

                    $response = $this->curl->request('post', $capture_link);
                      
                    if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
                    {
                        $response = json_decode($response->getBody());

                        if(strtoupper($response->status) === "COMPLETED")
                        {
                            $invoice_reference  = $response->purchase_units[0]->payments->captures[0]->invoice_id;
                            $transaction_id     = $response->purchase_units[0]->payments->captures[0]->id;
                            $amountPaid         = $response->purchase_units[0]->payments->captures[0]->amount->value;

                            if(!empty($invoice_reference) && !empty($transaction_id) && !empty($amountPaid))
                            {
                                $this->InvoiceController->markInvoiceAsPaid(
                                                $invoice_reference,
                                                $amountPaid,
                                                "Paypal",
                                                $transaction_id
                                            );
                            }
                        }
                    }
                }
            }

            // PAYMENT CAPTURE COMPLETED
            else if(strtoupper($body['event_type']) === 'PAYMENT.CAPTURE.COMPLETED' && strtoupper($body['resource']['status']) === 'COMPLETED')
            {
                $invoice_reference  = $body['purchase_units'][0]['payments']['captures'][0]['invoice_id'];
                $transaction_id     = $body['purchase_units'][0]['payments']['captures'][0]['id'];
                $amountPaid         = $body['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

                if(!empty($invoice_reference) && !empty($transaction_id) && !empty($amountPaid))
                {
                    $this->InvoiceController->markInvoiceAsPaid(
                                    $invoice_reference,
                                    $amountPaid,
                                    "Paypal",
                                    $transaction_id
                                );
                }
            }

            header("HTTP/1.1 200 OK");
            exit();
        }

        http_response_code(400);
        exit();
    }

    function verifyWebhookData($headers, $body)
    {
        $response = $this->curl->request('post', 'v1/notifications/verify-webhook-signature',
                [
                    'json'  =>
                    [
                        "auth_algo"         => $headers['PAYPAL-AUTH-ALGO'] ?? $headers['paypal-auth-algo'],
                        "cert_url"          => $headers['PAYPAL-CERT-URL'] ?? $headers['paypal-cert-url'],
                        "transmission_id"   => $headers['PAYPAL-TRANSMISSION-ID'] ?? $headers['paypal-transmission-id'],
                        "transmission_sig"  => $headers['PAYPAL-TRANSMISSION-SIG'] ?? $headers['paypal-transmission-sig'],
                        "transmission_time" => $headers['PAYPAL-TRANSMISSION-TIME'] ?? $headers['paypal-transmission-time'],
                        "webhook_event"     => $body,
                        "webhook_id"        => $this->PaypalData['webhook_key'],
                    ]
                ]
            );

        if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
        {
            $response = json_decode($response->getBody());
            if(strtolower($response->verification_status) === "success")
            {        
                return true;
            }
        }

        return false;
    }

    public function successfulPayment()
    {
        $token = $_GET['token'];
        $PayerID = $_GET['PayerID'];

        $response = $this->curl->request('post', 'v2/checkout/orders/'.$token.'/capture');

        if($response->getStatusCode() >=200 && $response->getStatusCode() < 300)
        {
            $response = json_decode($response->getBody());

            if(strtoupper($response->status) === "COMPLETED")
            {
                $invoice_reference  = $response->purchase_units[0]->payments->captures[0]->invoice_id;
                $transaction_id     = $response->purchase_units[0]->payments->captures[0]->id;
                $amountPaid         = $response->purchase_units[0]->payments->captures[0]->amount->value;

                if(!empty($invoice_reference) && !empty($transaction_id) && !empty($amountPaid))
                {
                    $this->InvoiceController->markInvoiceAsPaid(
                                    $invoice_reference,
                                    $amountPaid,
                                    "Paypal",
                                    $transaction_id
                                );

                    return "success";
                }
            }
        }

        if(!empty($this->PaypalData['webhook_key']))
        {// IF WEBHOOK IS ENABLED, THE PAYMENT MIGHT GET UPDATED LATER VIA THE WEBHOOK 
            return "processing";
        }

        return "failed";
    }
}