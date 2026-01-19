<?php namespace App\Controllers\PaymentGateways;
use App\Controllers\BaseController;
use App\Controllers\InvoiceController;
use App\Models\InvoiceModel;
use App\Models\PaymentGatewaysModel;

class StarterTemplateController extends BaseController
{
    private $starterTemplateData;

    public function __construct()
    {
        $this->InvoiceController = new InvoiceController();
        $this->InvoiceModel = new InvoiceModel();
        $this->PaymentGatewaysModel = new PaymentGatewaysModel();

        $this->starterTemplateData = $this->PaymentGatewaysModel
                                ->where('name', 'my_gateway_name')
                                ->first();
        
        // You can then access data fetched from database later in the script like this.
        $this->starterTemplateData['secret_key']; // SECRET KEY
        $this->starterTemplateData['public_key']; // PUBLIC KEY
        $this->starterTemplateData['webhook_key']; // WEBHOOK KEY
        $this->starterTemplateData['currency']; // CURRENCY
        // CHECK DATABASE FOR OTHER FIELDS
    }

    public function cancelledPayment($invoice_reference)
    {

    }

    public function failedPayment($invoice_reference)
    {

    }

    public function initiatePayment($invoice_reference, $total_price, $tax, $total_due, $data, $user)
    {

    }

    public function processWebHook()
    {

    }

    public function successfulPayment()
    {
        // VERIFY PAYMENT.
        
        // (IF YOUR GATEWAY USES A WEBHOOK, This Goes into processWebhook() function above)

        
        // IF PAYMENT IS SUCCESSFULLY VERIFIED AND CONFIMED AS SUCCESSFUL 
        $this->InvoiceController->markInvoiceAsPaid(
                            $invoice_reference, // The invoice reference passed to initiate_payment
                            $amountPaid,    // The amount paid by user
                            "my_gateway_name",  // The name of the gateway
                            $transaction_id // The transaction id from the payment gateway
                        );

        // IF YOU ARE NOT VERIFYING PAYMENT HERE (SAY YOU ARE USING A WEBHOOK) 
        return "processing";
        
        // IF YOU VERIFY PAYMENT AND MARK INVOICE AS PAID HERE
        return "success";
        
        // IF PAYMENT FAILED
        return "failed";
        
        //IF PAYMENT CANNOT BE VERIFIED
        return "unknown";
    }
}