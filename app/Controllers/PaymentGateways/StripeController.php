<?php namespace App\Controllers\PaymentGateways;
use App\Controllers\BaseController;
use App\Controllers\InvoiceController;
use App\Models\InvoiceModel;
use App\Models\PaymentGatewaysModel;

class StripeController extends BaseController
{    
    private $stripeData;

    public function __construct()
    {
        $this->InvoiceController = new InvoiceController();
        $this->InvoiceModel = new InvoiceModel();
        $this->PaymentGatewaysModel = new PaymentGatewaysModel();

        $this->stripeData   = $this->PaymentGatewaysModel
                                ->where('name', 'stripe')
                                ->first();

    }
    
    public function cancelledPayment()
    {

    }
    
    public function failedPayment()
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
                    'price_data'    => [
                        'currency'      => $this->stripeData['currency'],
                        'unit_amount'   => $d['unit_price'] * 100,
                        'product_data'  => [
                            'name'     => $d['name'],
                        ],
                    ],
                    'quantity'          => $d['quantity'] ?? 1,
                ];
            }
        }

        // CUSTOM ITEMS ADDED BY ADMIN
        if(!empty($data['custom_items']))
        {
            foreach($data['custom_items'] as $d)
            {
                $items[] = [
                    'price_data'    => [
                        'currency'      => $this->stripeData['currency'],
                        'unit_amount'   => $d['price'] * 100,
                        'product_data'  => [
                            'name'     => $d['name'],
                        ],
                    ],
                    'quantity'          => $d['quantity'] ?? 1,
                ];
            } 
        }

        // SHIPPING DETAILS
        if(!empty($data['shipping']))
        {
            $items[] = [
                'price_data'    => [
                    'currency'      => $this->stripeData['currency'],
                    'unit_amount'   => $data['shipping']['shipping_fee'] * 100,
                    'product_data'  => [
                        'name'     => $data['shipping']['item_name'],
                    ],
                ],
                'quantity'          => 1,
            ];
        }
        
        // SUBSCRIPTION PLANS
        if(!empty($data['subscription']))
        {
            $items[] = [
                'price_data'    => [
                    'currency'      => $this->stripeData['currency'],
                    'unit_amount'   => $data['subscription']['total_price'] * 100,
                    'product_data'  => [
                        'name'     => $data['subscription']['name'].' ('.$data['subscription']['duration'].')',
                    ],
                ],
                'quantity'          => 1,
            ];
        }

        if(!empty($tax))
        {
            $items[] = [
                'price_data'    => [
                    'currency'      => $this->stripeData['currency'],
                    'unit_amount'   => $tax * 100,
                    'product_data'  => [
                        'name'     => 'tax',
                    ],
                ],
                'quantity'          => 1,
            ];
        }

        \Stripe\Stripe::setApiKey($this->stripeData['secret_key']);

        $checkout_session = \Stripe\Checkout\Session::create(
            [
                'line_items'            => [
                                                $items
                                            ],

                'metadata'              => [
                                                'invoice_reference'    => $invoice_reference,
                                                'user_id'           => $user['id'],
                                            ],
                'customer_email'        =>      $user['email'],
                'mode'                  =>      'payment',
                'success_url'           =>      fullUrl(route_to('payment_success_url', 'stripe')),
                'cancel_url'            =>      fullUrl(route_to('payment_cancel_url', 'stripe', $invoice_reference)),
            ]
        );

        return redirect()->to($checkout_session->url);
    }

    public function processWebHook()
    {
        \Stripe\Stripe::setApiKey($this->stripeData['secret_key']);

        $endpoint_secret = $this->stripeData['webhook_key'];

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        $session = $event->data->object;

        $invoice_reference = $session->metadata->invoice_reference;
        $amountPaid = $session->amount_total / 100;
        $transaction_id = $session->payment_intent;

        switch ($event->type) {
            case 'checkout.session.completed':
                    if ($session->payment_status == 'paid') {
                        $this->InvoiceController->markInvoiceAsPaid(
                            $invoice_reference,
                            $amountPaid,
                            "Stripe",
                            $transaction_id
                        );
                    }
            break;

            case 'checkout.session.async_payment_succeeded':
                    $this->InvoiceController->markInvoiceAsPaid(
                        $invoice_reference,
                        $amountPaid,
                        "Stripe",
                        $transaction_id
                    );
            break;

            case 'checkout.session.async_payment_failed':
                    $this->InvoiceController->markInvoiceAsFailed($invoice_reference);
            break;
            }

        http_response_code(200);
    }
    
    public function successfulPayment()
    {
        return "processing";
    }
}