<?php

function sendMail($subject, $message, $to, $copy = [])
{
    $email = \Config\Services::email();

    if(strtolower(getSetting('mail_protocol')) == 'smtp')
    {
        $config['protocol']         = 'smtp';

        $config['SMTPHost']         = getSetting('smtp_host');
        $config['SMTPUser']         = getSetting('smtp_user');
        $config['SMTPPass']         = getSetting('smtp_pass');

        $config['SMTPPort']         = getSetting('smtp_port') ?? 25;
        $config['SMTPTimeout']      = getSetting('smtp_timeout') ?? 5;
        $config['SMTPKeepAlive']    = getSetting('smtp_keep_alive') ?? FALSE;
        $config['SMTPCrypto']       = getSetting('smtp_encryption') ?? 'tls';

    }
    elseif(strtolower(getSetting('mail_protocol')) == 'sendmail')
    {
        $config['protocol']     = 'sendmail';
        $config['mailPath']     = getSetting('sendmail_path');
    }
    else
    {
        $config['protocol']     = 'mail';   
    }
    
    $config['charset']          = getSetting('mail_charset') ?? 'utf-8';
    $config['wordWrap']         = true;
    $config['mailType']         = 'html';


    $email->initialize($config);
    $email->setFrom(getSetting('sender_email'), getSetting('sender_name'));
    $email->setTo($to);

    $email->setSubject($subject);
    $email->setMessage($message);
    $email->send();

    return true;
}

function prepareMail($mail_type, $email, $items = [])
{
    $AuthModel = new \App\Models\AuthModel();
    $user = $AuthModel->where('email', $email)->first();

    // if(strtolower(getSetting('enable_'.$mail_type)) != 'yes' || empty($user))
    if(!isEnabled($mail_type) || empty($user))
    {
        return;
    }

    $data['message'] = str_replace(
        [
            '{{FIRSTNAME}}',
            '{{LASTNAME}}',
            '{{USERNAME}}',
            '{{RESET PASSWORD BUTTON}}',
            '{{RESET PASSWORD LINK}}',
            '{{VERIFY EMAIL BUTTON}}',
            '{{VERIFY EMAIL LINK}}',
            '{{ORDER STATUS}}',
            '{{ORDER TABLE}}',
            '{{SUBSCRIPTION STATUS}}',
            '{{SUBSCRIPTION TABLE}}',
            '{{PICKUP TIME}}',
            '{{TIME LEFT}}',
            '{{INVOICE ID}} ',
            '{{VIEW INVOICE DETAILS BUTTON}}',
            '{{PAID INVOICE TABLE}}',
            '{{UNPAID INVOICE TABLE}}',
            '{{PAY INVOICE BUTTON}}'
        ],

        [
            $user['firstname'],
            $user['lastname'],
            $user['username'],
            $items['reset_password_button'] ?? '',
            $items['reset_password_link'] ?? '',
            $items['verify_email_button'] ?? '',
            $items['verify_email_link'] ?? '',
            $items['order_status']   ?? '',
            $items['order_table']   ?? '',
            $items['subscription_status']   ?? '',
            $items['subscription_table']   ?? '',
            $items['pickup_time']          ?? '',
            $items['time_left']          ?? '',
            $items['invoice_id']        ?? '',
            $items['view_invoice_details_button']   ?? '',
            $items['paid_invoice_table']  ?? '',
            $items['unpaid_invoice_table']  ?? '',
            $items['pay_invoice_button']  ?? '',
        ],

        getSetting($mail_type.'_message')
    );
    $data['subject']    = getSetting($mail_type.'_subject');

    $message = view(mailLayout(), $data);

    return sendMail(getSetting($mail_type.'_subject'), $message, $user['email']);
}



function sendWelcomeEmail($email)
{
    return prepareMail('welcome_mail', $email);
}

function sendVerifyAccountEmail($email)
{
    $UserVerificationModel = new \App\Models\UserVerificationModel();
    $verify_link = $UserVerificationModel->getVerifyAccountLink($email);
        
    $data   =   [
                    'verify_email_link'   => $verify_link,
                    'verify_email_button' => view(
                                                    mailTheme().'/partials/_button',
                                                    [
                                                        'button_link'   => $verify_link,
                                                        'button_text'   => lang('Email.verify_your_account'),
                                                    ]
                                                ),
                ];

    return prepareMail('verify_account_mail', $email, $data);
}

function sendResetPasswordEmail($email)
{
    $UserVerificationModel = new \App\Models\UserVerificationModel();
    $reset_link = $UserVerificationModel->getResetPasswordLink($email);
    
    $data   =   [
                    'reset_password_link'   => $reset_link,
                    'reset_password_button' => view(
                                                    mailTheme().'/partials/_button',
                                                    [
                                                        'button_link'   => $reset_link,
                                                        'button_text'   => lang('Email.reset_password'),
                                                    ]
                                                ),
                ];

    return prepareMail('reset_password_mail', $email, $data);
}

function sendOrderConfirmedEmail($email, $order_id)
{
    $OrderModel = new \App\Models\OrderModel();
    $order      = $OrderModel->where('id', $order_id)->first();
    
    if(empty($order))
    {
        return;
    }

    $OrderDetailsModel = new \App\Models\OrderDetailsModel();

    $OrderDetailsModel->select('order_details.*, products.name as product_name,
                                        product_services.name as product_service_name')
            ->where('order_id', $order['id'])
            ->join('products', 'products.id = order_details.product_id')
            ->join('product_services', 'product_services.id = order_details.product_service_id');

    $order_details      = $OrderDetailsModel->get()->getResultArray();

    if($order['has_shipping'] == 'yes')
    {
        $shipping_details   = $OrderShippingsModel->where('order_id', $order['id'])->first();

        if(!empty($shipping_details))
        {
            $LocationsModel = new \App\Models\LocationsModel();
            $location_details = $LocationsModel->where('id', $shipping_details['location_id'])->first();
        }
    }
    
    if($order['has_custom_items'] == 'yes')
    {
        $OrderCustomItemsModel  = new \App\Models\OrderCustomItemsModel();
        $custom_items           = $OrderCustomItemsModel->where('order_id', $order['id'])->findAll();
    }


    $data = [
        'order_status'  => $order['status'],
        'order_table'   => view(
                                    mailTheme().'/partials/_order_table',
                                    [
                                        'order_details'     => $order_details,
                                        'shipping_details'  => $shipping_details ?? NULL,
                                        'location_details'  => $location_details ?? NULL,
                                        'custom_items'      => $custom_items ?? NULL,
                                    ]
                                ),
    ];

    return prepareMail('order_confirmed_mail', $email, $data);
}

function sendSubscriptionConfirmedEmail($email, $subscription_id)
{
    $SubscriptionModel = new \App\Models\SubscriptionModel();

    $subscription = $SubscriptionModel->select('subscriptions.*, 
                                    plans.name as plan_name, 
                                    concat(users.firstname," ",users.lastname) as subscriber_name,
                                    users.email, users.phone, users.avatar
                                ')
                        ->join('plans', 'plans.id = subscriptions.plan_id')
                        ->join('users', 'users.id = subscriptions.user_id')
                        ->where('subscriptions.id', $subscription_id)->first();

    if(empty($subscription))
    {
        return;
    }

    $data = [
                'subscription_status'   => $subscription['status'],
                'subscription_table'    => view(
                                                    mailTheme().'/partials/_subscription_table',
                                                    [
                                                        'subscription'  => $subscription
                                                    ]
                                            ),
        ];

    return prepareMail('subscription_confirmed_mail', $email, $data);
}

function sendPickupScheduledEmail($email, $pickup_time)
{
    return prepareMail('pickup_scheduled_mail', ['pickup_time'  => formatDateTime($pickup_time)]);

}

function sendPickupScheduleReminderEmail($email, $pickup_time)
{
    $time = \CodeIgniter\I18n\Time::parse(strtotime($pickup_time));

    return prepareMail('pickup_schedule_reminder_mail', ['time_left'  => $time->humanize()]);
}

function sendPickupSuccessfulEmail($email)
{
    return prepareMail('pickup_successful_mail', $email);
}

function sendPickupFailedEmail($email)
{
    return prepareMail('pickup_failed_mail', $email);
}

function sendDeliveryScheduledEmail($email, $delivery_time)
{
    return prepareMail('delivery_scheduled_mail', ['delivery_time'  => formatDateTime($delivery_time)]);

}

function sendDeliveryScheduleReminderEmail($email, $delivery_time)
{
    $time = \CodeIgniter\I18n\Time::parse(strtotime($delivery_time));

    return prepareMail('delivery_schedule_reminder_mail', ['time_left'  => $time->humanize()]);
}

function sendDeliverySuccessfulEmail($email)
{
    return prepareMail('delivery_successful_mail', $email);
}

function sendDeliveryFailedEmail($email)
{
    return prepareMail('delivery_failed_mail', $email);
}

function sendInvoiceCreatedEmail($email, $invoice_id)
{
    $InvoiceModel = new \App\Models\InvoiceModel();
    $invoice = $InvoiceModel->where('id', $invoice_id)->first();

    $data = [
        'invoice_id'                => $invoice['reference'],
        'unpaid_invoice_table'      => view(
                                            mailTheme().'/partials/_unpaid_invoice_table',
                                            [
                                                'invoice' => $invoice,
                                            ]
                                    ),

        'pay_invoice_button'        => view(
                                            mailTheme().'/partials/_button',
                                            [
                                                'button_link'   => fullUrl(route_to('pay_invoice', $invoice['reference'])),
                                                'button_text'   => lang('Email.pay_invoice'),
                                            ]
                                        ),

        'view_invoice_details_button' => view   (
                                            mailTheme().'/partials/_button',
                                            [
                                                'button_link'   => fullUrl(route_to('user_route_view_invoice', $invoice['id'])),
                                                'button_text'   => lang('Email.invoice_details'),
                                            ]
                                        ),
    ];
    
    return prepareMail('invoice_created_mail', $email, $data);
}

function sendInvoicePaidEmail($email, $invoice_id)
{
    $InvoiceModel = new \App\Models\InvoiceModel();
    $invoice = $InvoiceModel->where('id', $invoice_id)->first();

    $data = [
        'invoice_id'            => $invoice['reference'],
        'paid_invoice_table'    => view(
                                        mailTheme().'/partials/_paid_invoice_table',
                                        [
                                            'invoice' => $invoice,
                                        ]
                                ),

        'view_invoice_details_button' => view   (
                                    mailTheme().'/partials/_button',
                                    [
                                        'button_link'   => fullUrl(route_to('user_route_view_invoice', $invoice['id'])),
                                        'button_text'   => lang('Email.invoice_details'),
                                    ]
                                ),
    ];
    
    return prepareMail('invoice_paid_mail', $email, $data);
}