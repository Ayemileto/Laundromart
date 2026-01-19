<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

##############
# FRONT ROUTES
##############
$routes->group('', function($routes)
{
    $routes->group('install', ['namespace' => 'App\Controllers\Installer'], function($routes)
    {
        $routes->get('',                    'InstallController::index',          ['as'   => 'install']);
        $routes->post('',                   'InstallController::save');
    });

    $routes->get('/',               'HomeController::index',                    ['as' => 'home']);
    $routes->get('products',        'HomeController::products',                 ['as' => 'products', 'filter' => 'PagesFilter:products']);
    $routes->get('product/(:num)',  'HomeController::product_services/$1',      ['as' => 'product_services']);
    $routes->get('product/services', 'HomeController::select_product_services', ['as' => 'select_option_product_services']);
    $routes->get('plans',           'HomeController::plans',                    ['as' => 'plans', 'filter' => 'PagesFilter:subscription_plans']);
    $routes->get('branch-locator',  'HomeController::BranchLocator',            ['as' => 'branch-locator', 'filter' => 'PagesFilter:branch_locator']);
    $routes->get('contact-us',      'HomeController::ContactUs',                ['as' => 'contact-us', 'filter' => 'PagesFilter:contact_us']);
    $routes->post('contact-us',     'HomeController::SendContactMessage',       ['as' => 'send_contact_message']);
    $routes->get('page/(:any)',     'HomeController::page/$1',                  ['as' => 'page']);

    $routes->group('cart', function($routes){
        $routes->get('',                'ShoppingCartController::index',        ['as' => 'user_route_cart']);
        $routes->post('add',            'ShoppingCartController::add',          ['as' => 'user_route_add_product_to_cart']);
        $routes->post('remove',         'ShoppingCartController::remove',       ['as' => 'user_route_remove_product_from_cart']);
        $routes->post('update',         'ShoppingCartController::update',       ['as' => 'user_route_change_cart_product_quantity']);
    });

    $routes->group('invoice', function($routes)
    {
        $routes->get('pay/(:any)',      'InvoiceController::pay/$1',            ['as'  => 'pay_invoice']);
        $routes->post('pay/(:any)',     'InvoiceController::do_pay/$1',         ['as'  => 'do_pay_invoice']);
    });

    $routes->group('payments', function($routes)
    {
        $routes->get('(:any)/(:any)/failed',    'PaymentController::failedPayment/$1',          ['as' => 'payment_fail_url']);
        $routes->get('(:any)/(:any)/cancel',    'PaymentController::cancelledPayment/$1/$2',    ['as' => 'payment_cancel_url']);
        $routes->get('(:any)/success',          'PaymentController::successfulPayment/$1',      ['as' => 'payment_success_url']);
        $routes->post('(:any)/webhook',         'PaymentController::processWebHook/$1',         ['as' => 'payment_webhook_url']);
        $routes->get('(:any)',                  'PaymentController::messages/$1',               ['as' => 'payment_messages']);
    });
});


##############
# AUTH ROUTES
##############
$routes->get('logout', 'AuthController::logout',                                ['as' => 'logout']);

$routes->group('', ['filter' => 'NotAuthFilter'], function($routes){
    $routes->get('login',           'AuthController::login',                    ['as' => 'login']);
    $routes->post('login',          'AuthController::do_login',                 ['as' => 'do_login']);
    $routes->get('register',        'AuthController::register',                 ['as' => 'register']);
    $routes->post('register',       'AuthController::do_register',              ['as' => 'do_register']);

    $routes->get('forgot-password',  'AuthController::forgot_password',         ['as' => 'forgot_password']);
    $routes->post('forgot-password', 'AuthController::do_forgot_password',      ['as' => 'do_forgot_password']);
    
    $routes->get('resend',      'AuthController::resend_verification_link',     ['as' => 'resend_verification_link']);
    $routes->post('resend',     'AuthController::do_resend_verification_link',  ['as' => 'do_resend_verification_link']);
    
    $routes->get('verify/(:num)/(:any)', 'AuthController::verify/$1/$2',        ['as' => 'verify_user']);
    $routes->get('resetpassword',        'AuthController::reset_password',      ['as' => 'reset_password']);
    $routes->post('resetpassword',       'AuthController::do_reset_password',   ['as' => 'do_reset_password']);
});


##############
# PROFILE & DASHBOARD ROUTES
##############
$routes->group('/', ['filter' => 'AuthFilter'], function($routes){
    
    $routes->group('profile', function($routes){
        $routes->get('/', 'AuthController::index',                              ['as' => 'profile']);
        // $routes->get('update', 'AuthController::updateuser',                    ['as' => 'updateuser']);
        $routes->post('/', 'AuthController::do_update',                         ['as' => 'do_updateuser']);
        $routes->post('update/password', 'AuthController::update_password',     ['as' => 'do_update_password']);
        $routes->post('update/picture', 'AuthController::update_profile_pic',   ['as' => 'do_update_profile_pic']);
        $routes->get('orders', 'OrderController::index',                        ['as' => 'orders']); 
    });
});


##############
# USER ROUTES
##############
$routes->group('user', ['filter' => 'AuthFilter', 'namespace' => 'App\Controllers\User'], function($routes)
{
    $routes->get('dashboard',           'DashboardController::index',           ['as' => 'user_dashboard']);

    $routes->group('calendar', function($routes){
        $routes->get('/',               'CalendarController::index',            ['as' => 'user_route_calendar']);
        $routes->get('fetch-items',     'CalendarController::fetchItems',       ['as' => 'user_route_fetch_calendar_items']);
    });
    
    $routes->group('deliveries', function($routes){
        $routes->get('(:alpha)',            'ShippingController::deliveries/$1',        ['as' => 'user_route_deliveries']);
        $routes->get('(:num)/view',         'ShippingController::view/$1',              ['as' => 'user_route_delivery_details']);        
    });

    $routes->group('invoices', function($routes){
        $routes->get('(:num)/view',         'InvoiceController::view/$1',       ['as' => 'user_route_view_invoice']);
        $routes->get('(:alpha)',            'InvoiceController::index/$1',      ['as' => 'user_route_invoices']);
    });

    $routes->group('orders', function($routes){
        $routes->get('(:alpha)',            'OrderController::index/$1',        ['as' => 'user_route_orders']);
        $routes->get('(:num)/view',         'OrderController::view/$1',         ['as' => 'user_route_order_details']);
        // $routes->get('(:num)/edit',         'OrderController::edit/$1',         ['as' => 'user_route_order_edit']);
        $routes->get('(:num)/cancel',       'OrderController::cancel/$1',       ['as' => 'user_route_order_cancel']);
    });

    $routes->group('pickups', function($routes){
        $routes->get('(:alpha)',            'ShippingController::pickups/$1',           ['as' => 'user_route_pickups']);
        $routes->get('(:num)/view',         'ShippingController::view/$1',              ['as' => 'user_route_pickup_details']);
    });
    
    $routes->group('subscription', function($routes)
    {
        $routes->group('(:num)/orders', function($routes)
        {
            $routes->get('create',   'SubscriptionOrderController::create/$1',   ['as' => 'user_route_create_subscription_order']);
            $routes->get('checkout', 'SubscriptionOrderController::checkout/$1', ['as' => 'user_route_checkout_subscription_order']);
        });

        $routes->group('(:num)/cart', function($routes)
        {
            $routes->post('add',  'SubscriptionCartController::add/$1',           ['as' => 'user_route_add_product_to_subscription_order']);
            $routes->get('delete/(:num)/(:num)',  'SubscriptionCartController::delete/$1/$2/$3',           ['as' => 'user_route_delete_product_from_subscription_order']);
            $routes->get('summary',  'SubscriptionCartController::summary/$1',   ['as' => 'user_route_subscription_order_summary']);
        });
    });
        
    $routes->group('subscriptions', function($routes)
    {
        $routes->get('(:alpha)',    'SubscriptionController::index/$1',         ['as' => 'user_route_subscriptions']);
        $routes->get('(:num)/view', 'SubscriptionController::view/$1',          ['as' => 'user_route_subscription_details']);
        // $routes->get('(:num)/edit', 'SubscriptionController::edit/$1',          ['as' => 'user_route_edit_subscription']);
        $routes->get('(:num)/cancel', 'SubscriptionController::cancel/$1',      ['as' => 'user_route_cancel_subscription']);
        
        $routes->get('subscribe/(:num)',  'SubscriptionController::subscribe/$1',    ['as' => 'user_route_subscribe']);
        $routes->post('subscribe/(:num)', 'SubscriptionController::do_subscribe/$1', ['as' => 'user_route_do_subscribe']);
    });

    $routes->group('checkout', function($routes)
    {
        $routes->get('',                    'CheckoutController::index',                ['as' => 'user_route_checkout_products']);
        $routes->post('',                   'CheckoutController::save',                 ['as' => 'user_route_complete_products_checkout_and_pay']);
        $routes->post('checkdate/pickup',   'CheckoutController::checkDate/pickup',     ['as' => 'check_pickup_date']);
        $routes->post('checkdate/delivery', 'CheckoutController::checkDate/delivery',   ['as' => 'check_delivery_date']);
        $routes->get('zipcodes',            'CheckoutController::zipCodes',             ['as' => 'search-zipcodes']);
    
    });
       
});



################
# Admin ROUTES
################
$routes->group('admin', ['filter' => 'AdminFilter', 'namespace' => 'App\Controllers\Admin'], function($routes)
{
    $routes->get('dashboard',           'DashboardController::index',           ['as' => 'admin_dashboard', 'filter' => 'AdminFilter:dashboard']);

    $routes->group('analytics', function($routes){
        $routes->group('stats', function($routes){
            $routes->get('sales',                   'AnalyticsController::sales',           ['as' => 'admin_route_sales_stats', 'filter' => 'AdminFilter:view_statistic']);
            $routes->get('salesbyproducts',         'AnalyticsController::salesByProducts',         ['as' => 'admin_route_statistics_salesbyproducts', 'filter' => 'AdminFilter:view_statistic']);
            $routes->get('subscriptionsbyplans',    'AnalyticsController::subscriptionsByPlans',    ['as' => 'admin_route_statistics_subscriptionsbyplans', 'filter' => 'AdminFilter:view_statistic']);
            $routes->get('visitors',                'AnalyticsController::visitors',        ['as' => 'admin_route_visitors_stats', 'filter' => 'AdminFilter:view_statistic']);
        });
        
        $routes->get('(:alpha)',       'AnalyticsController::analytics/$1',       ['as' => 'admin_route_analytics', 'filter' => 'AdminFilter:view_statistic']);
    });

    $routes->group('calendar', function($routes){
        $routes->get('/',               'CalendarController::index',            ['as' => 'admin_route_calendar', 'filter' => 'AdminFilter:view_calendar']);
        $routes->get('fetch-items',     'CalendarController::fetchItems',       ['as' => 'admin_route_fetch_calendar_items', 'filter' => 'AdminFilter:view_calendar']);
    });
    
    $routes->group('deliveries', function($routes){
        $routes->post('update',             'ShippingController::update',               ['as' => 'admin_route_update_delivery', 'filter' => 'AdminFilter:update_shipping']);
        $routes->get('(:alpha)',            'ShippingController::deliveries/$1',        ['as' => 'admin_route_deliveries', 'filter' => 'AdminFilter:view_shipping']);
        $routes->get('(:num)/edit',         'ShippingController::edit/delivery/$1',     ['as' => 'admin_route_edit_delivery', 'filter' => 'AdminFilter:update_shipping']);
        $routes->get('(:num)/view',         'ShippingController::view/$1',              ['as' => 'admin_route_delivery_details', 'filter' => 'AdminFilter:view_shipping']);
        $routes->get('(:num)/failed',       'ShippingController::failed/delivery/$1',   ['as' => 'admin_route_mark_delivery_as_failed', 'filter' => 'AdminFilter:update_shipping']);
        $routes->get('(:num)/complete',     'ShippingController::complete/delivery/$1', ['as' => 'admin_route_mark_delivery_as_complete', 'filter' => 'AdminFilter:update_shipping']);
        
    });

    $routes->group('invoices', function($routes){
        $routes->get('create',              'InvoiceController::create',        ['as' => 'admin_route_create_invoice', 'filter' => 'AdminFilter:add_invoice']);
        $routes->post('save',               'InvoiceController::save',          ['as' => 'admin_route_save_invoice', 'filter' => 'AdminFilter:add_invoice']);
        $routes->get('(:num)/view',         'InvoiceController::view/$1',       ['as' => 'admin_route_view_invoice', 'filter' => 'AdminFilter:view_invoice']);
        $routes->get('(:num)/paid',         'InvoiceController::paid/$1',       ['as' => 'admin_route_mark_invoice_as_paid', 'filter' => 'AdminFilter:update_invoice']);
        $routes->post('paid',               'InvoiceController::do_paid',       ['as' => 'admin_route_do_mark_invoice_as_paid', 'filter' => 'AdminFilter:update_invoice']);
        $routes->get('(:num)/cancel',       'InvoiceController::cancel/$1',     ['as' => 'admin_route_payment_cancel', 'filter' => 'AdminFilter:update_invoice']);
        $routes->post('cancel',             'InvoiceController::do_cancel',     ['as' => 'admin_route_do_payment_cancel', 'filter' => 'AdminFilter:update_invoice']);
        $routes->get('(:num)/add-item',     'InvoiceController::addItem/$1',    ['as' => 'admin_route_add_item_to_invoice', 'filter' => 'AdminFilter:update_invoice']);
        $routes->post('add-item',           'InvoiceController::saveItem',      ['as' => 'admin_route_save_item_to_invoice', 'filter' => 'AdminFilter:update_invoice']);
        $routes->get('(:alpha)',            'InvoiceController::index/$1',      ['as' => 'admin_route_invoices', 'filter' => 'AdminFilter:view_invoice']);
    });

    $routes->group('orders', function($routes){
        $routes->get('create',              'OrderController::create',          ['as' => 'admin_route_create_order', 'filter' => 'AdminFilter:add_order']);
        $routes->post('create/add-product', 'OrderController::addProduct',      ['as' => 'admin_route_add_product_to_order', 'filter' => 'AdminFilter:add_order']);
        $routes->get('(:alpha)',            'OrderController::index/$1',        ['as' => 'admin_route_orders', 'filter' => 'AdminFilter:view_order']);
        $routes->get('(:num)/view',         'OrderController::view/$1',         ['as' => 'admin_route_order_details', 'filter' => 'AdminFilter:view_order']);
        // $routes->get('(:num)/edit',         'OrderController::edit/$1',         ['as' => 'admin_route_order_edit', 'filter' => 'AdminFilter:update_order']);
        $routes->get('(:num)/cancel',       'OrderController::cancel/$1',       ['as' => 'admin_route_order_cancel', 'filter' => 'AdminFilter:update_order']);
        $routes->get('(:num)/complete',     'OrderController::complete/$1',     ['as' => 'admin_route_mark_order_as_complete', 'filter' => 'AdminFilter:update_order']);
    });

    $routes->group('pages', function($routes){
        $routes->get('/',               'PageController::index',                ['as' => 'admin_route_pages', 'filter' => 'AdminFilter:view_page']);
        $routes->get('create',          'PageController::create',               ['as' => 'admin_route_create_page', 'filter' => 'AdminFilter:add_page']);
        $routes->post('save',           'PageController::save',                 ['as' => 'admin_route_save_page', 'filter' => 'AdminFilter:add_page']);
        $routes->get('(:num)/edit',     'PageController::edit/$1',              ['as' => 'admin_route_edit_page', 'filter' => 'AdminFilter:update_page']);
        $routes->post('(:num)/update',  'PageController::update/$',             ['as' => 'admin_route_update_page', 'filter' => 'AdminFilter:update_page']);
        $routes->get('(:num)/delete',   'PageController::delete/$1',            ['as' => 'admin_route_delete_page', 'filter' => 'AdminFilter:delete_page']);
    });
    
    $routes->group('pickups', function($routes){
        $routes->post('update',             'ShippingController::update',               ['as' => 'admin_route_update_pickup', 'filter' => 'AdminFilter:update_shipping']);
        $routes->get('(:alpha)',            'ShippingController::pickups/$1',           ['as' => 'admin_route_pickups', 'filter' => 'AdminFilter:view_shipping']);
        $routes->get('(:num)/edit',         'ShippingController::edit/pickup/$1',       ['as' => 'admin_route_edit_pickup', 'filter' => 'AdminFilter:update_shipping']);
        $routes->get('(:num)/view',         'ShippingController::view/$1',              ['as' => 'admin_route_pickup_details', 'filter' => 'AdminFilter:view_shipping']);
        $routes->get('(:num)/failed',       'ShippingController::failed/pickup/$1',     ['as' => 'admin_route_mark_pickup_as_failed', 'filter' => 'AdminFilter:update_shipping']);
        $routes->get('(:num)/complete',     'ShippingController::complete/pickup/$1',   ['as' => 'admin_route_mark_pickup_as_complete', 'filter' => 'AdminFilter:update_shipping']);
    });

    $routes->group('plans', function($routes)
    {
        $routes->get('/',                   'PlanController::index',            ['as' => 'admin_route_list_plan', 'filter' => 'AdminFilter:view_plan']);
        $routes->get('(:num)',              'PlanController::view/$1',          ['as' => 'admin_route_view_plan', 'filter' => 'AdminFilter:view_plan']);
        $routes->get('add',                 'PlanController::add',              ['as' => 'admin_route_add_plan', 'filter' => 'AdminFilter:add_plan']);
        $routes->post('add',                'PlanController::save',             ['as' => 'admin_route_save_plan', 'filter' => 'AdminFilter:add_plan']);
        $routes->get('(:num)/edit',         'PlanController::edit/$1',          ['as' => 'admin_route_edit_plan', 'filter' => 'AdminFilter:update_plan']);
        $routes->post('(:num)/update',      'PlanController::update/$1',        ['as' => 'admin_route_update_plan', 'filter' => 'AdminFilter:update_plan']);
        $routes->get('(:num)/activate',     'PlanController::activate/$1',      ['as' => 'admin_route_activate_plan', 'filter' => 'AdminFilter:update_plan']);
        $routes->get('(:num)/deactivate',   'PlanController::deactivate/$1',    ['as' => 'admin_route_deactivate_plan', 'filter' => 'AdminFilter:update_plan']);
        $routes->get('(:num)/delete',       'PlanController::delete/$1',        ['as' => 'admin_route_delete_plan', 'filter' => 'AdminFilter:delete_plan']);
    });

    $routes->group('product/services', function($routes)
    {
        $routes->get('/',               'ProductServicesController::index',      ['as' => 'admin_route_list_product_services', 'filter' => 'AdminFilter:view_product_service']);
        $routes->get('add',             'ProductServicesController::add',        ['as' => 'admin_route_add_product_services', 'filter' => 'AdminFilter:add_product_service']);
        $routes->post('add',            'ProductServicesController::save',       ['as' => 'admin_route_save_product_services', 'filter' => 'AdminFilter:add_product_service']);
        $routes->get('(:num)/edit',     'ProductServicesController::edit/$1',    ['as' => 'admin_route_edit_product_services', 'filter' => 'AdminFilter:update_product_service']);
        $routes->post('(:num)/update',  'ProductServicesController::update/$1',  ['as' => 'admin_route_update_product_services', 'filter' => 'AdminFilter:update_product_service']);
        $routes->get('(:num)/delete',   'ProductServicesController::delete/$1',  ['as' => 'admin_route_delete_product_services', 'filter' => 'AdminFilter:delete_product_service']);
    });

    $routes->group('products', function($routes)
    {
        $routes->get('/',                    'ProductController::index',        ['as' => 'admin_route_list_product', 'filter' => 'AdminFilter:view_product']);
        $routes->get('add',                 'ProductController::add',           ['as' => 'admin_route_add_product', 'filter' => 'AdminFilter:add_product']);
        $routes->post('add',                'ProductController::save',          ['as' => 'admin_route_save_product', 'filter' => 'AdminFilter:add_product']);
        $routes->get('(:num)/edit',         'ProductController::edit/$1',       ['as' => 'admin_route_edit_product', 'filter' => 'AdminFilter:update_product']);
        $routes->post('(:num)/update',      'ProductController::update/$1',     ['as' => 'admin_route_update_product', 'filter' => 'AdminFilter:update_product']);
        $routes->get('(:num)/activate',     'ProductController::activate/$1',   ['as' => 'admin_route_activate_product', 'filter' => 'AdminFilter:update_product']);
        $routes->get('(:num)/deactivate',   'ProductController::deactivate/$1', ['as' => 'admin_route_deactivate_product', 'filter' => 'AdminFilter:update_product']);
        $routes->get('(:num)/delete',       'ProductController::delete/$1',     ['as' => 'admin_route_delete_product', 'filter' => 'AdminFilter:delete_product']);
    });

    $routes->group('roles', function($routes)
    {
        $routes->get('/',               'RoleController::index',                ['as' => 'admin_route_role_list', 'filter' => 'AdminFilter:view_role']);
        $routes->get('add',             'RoleController::add',                  ['as' => 'admin_route_add_role', 'filter' => 'AdminFilter:add_role']);
        $routes->post('add',            'RoleController::save',                 ['as' => 'admin_route_save_role', 'filter' => 'AdminFilter:add_role']);
        $routes->get('(:num)/edit',     'RoleController::edit/$1',              ['as' => 'admin_route_edit_role', 'filter' => 'AdminFilter:update_role']);
        $routes->post('(:num)/update',  'RoleController::update/$1',            ['as' => 'admin_route_update_role', 'filter' => 'AdminFilter:update_role']);
        $routes->get('(:num)/delete',   'RoleController::delete/$1',            ['as' => 'admin_route_delete_role',  'filter' => 'AdminFilter:delete_role']);
    });

    $routes->group('settings', function($routes){
        $routes->get('payment',                 'AppSettingsController::paymentSettings',   ['as' => 'admin_route_payment_settings', 'filter' => 'AdminFilter:update_payment_setting']);
        $routes->post('payment/save',           'AppSettingsController::savePaymentSettings',   ['as' => 'admin_route_save_payment_settings', 'filter' => 'AdminFilter:update_payment_setting']);
        $routes->post('payment/default/save',   'AppSettingsController::saveDefaultGatewaySettings',   ['as' => 'admin_route_save_default_gateway_settings', 'filter' => 'AdminFilter:update_payment_setting']);
        
        $routes->group('location', function($routes)
        {
            $routes->get('',                'LocationSettingsController::index',        ['as' => 'admin_route_location_settings', 'filter' => 'AdminFilter:view_location']);
            $routes->get('add',             'LocationSettingsController::add',          ['as' => 'admin_route_add_location', 'filter' => 'AdminFilter:add_location']);
            $routes->post('save',           'LocationSettingsController::save',         ['as' => 'admin_route_save_location', 'filter' => 'AdminFilter:add_location']);
            $routes->get('(:num)/edit',     'LocationSettingsController::edit/$1',      ['as' => 'admin_route_edit_location', 'filter' => 'AdminFilter:update_location']);
            $routes->post('(:num)/update',  'LocationSettingsController::update/$1',    ['as' => 'admin_route_update_location', 'filter' => 'AdminFilter:update_location']);
            $routes->get('(:num)/delete',   'LocationSettingsController::delete/$1',    ['as' => 'admin_route_delete_location', 'filter' => 'AdminFilter:delete_location']);

            $routes->group('branch', function($routes)
            {
                $routes->get('add',             'LocationSettingsController::addBranch',             ['as' => 'admin_route_add_branch', 'filter' => 'AdminFilter:add_branch']);
                $routes->post('save',           'LocationSettingsController::saveBranch',            ['as' => 'admin_route_save_branch', 'filter' => 'AdminFilter:add_branch']);
                $routes->get('(:num)/edit',     'LocationSettingsController::editBranch/$1',         ['as' => 'admin_route_edit_branch', 'filter' => 'AdminFilter:update_branch']);
                $routes->post('(:num)/update',  'LocationSettingsController::updateBranch/$1',       ['as' => 'admin_route_update_branch', 'filter' => 'AdminFilter:update_branch']);
                $routes->get('(:num)/delete',   'LocationSettingsController::deleteBranch/$1',       ['as' => 'admin_route_delete_branch', 'filter' => 'AdminFilter:delete_branch']);
            });
        });

        $routes->post('save',           'AppSettingsController::save',          ['as' => 'admin_route_save_settings', 'filter' => 'AdminFilter:update_setting']);
        $routes->get('(:any)',          'AppSettingsController::settings/$1',   ['as' => 'admin_route_settings', 'filter' => 'AdminFilter:update_setting']);
    });

    $routes->group('staffs', function($routes)
    {
        $routes->get('/',                'StaffController::index',              ['as' => 'admin_route_list_staff', 'filter' => 'AdminFilter:view_staff']);
        $routes->get('(:num)/view',       'StaffController::view/$1',           ['as' => 'admin_route_view_staff', 'filter' => 'AdminFilter:view_staff']);
        $routes->get('add',              'StaffController::add',                ['as' => 'admin_route_add_staff', 'filter' => 'AdminFilter:add_staff']);
        $routes->post('add',             'StaffController::save',               ['as' => 'admin_route_save_staff', 'filter' => 'AdminFilter:add_staff']);
        $routes->get('(:num)/edit',      'StaffController::edit/$1',            ['as' => 'admin_route_edit_staff', 'filter' => 'AdminFilter:update_staff']);
        $routes->post('(:num)/update',   'StaffController::update/$1',          ['as' => 'admin_route_update_staff', 'filter' => 'AdminFilter:update_staff']);
        $routes->get('(:num)/remove',    'StaffController::remove/$1',          ['as' => 'admin_route_remove_staff', 'filter' => 'AdminFilter:delete_staff']);
        $routes->get('(:num)/delete',    'StaffController::delete/$1',          ['as' => 'admin_route_delete_staff', 'filter' => 'AdminFilter:delete_staff']);
    });

    $routes->group('statistics', function($routes)
    {
        $routes->get('visitors',            'StatisticsController::visitors',   ['as' => 'admin_route_visitors_stats', 'filter' => 'AdminFilter:view_statistic']);
    });
    
    $routes->group('subscriptions', function($routes)
    {
        $routes->get('(:alpha)',    'SubscriptionController::index/$1',         ['as' => 'admin_route_subscriptions', 'filter' => 'AdminFilter:view_subscription']);
        $routes->get('(:num)/view', 'SubscriptionController::view/$1',          ['as' => 'admin_route_subscription_details', 'filter' => 'AdminFilter:view_subscription']);
        // $routes->get('(:num)/edit', 'SubscriptionController::edit/$1',          ['as' => 'admin_route_edit_subscription', 'filter' => 'AdminFilter:update_subscription']);
    });

    $routes->group('user-cart', function($routes){
        $routes->get('',            'OrderController::userCart',                ['as' => 'admin_route_user_cart_summary', 'filter' => 'AdminFilter:add_order']);
        $routes->get('delete',      'OrderController::userCart/$1',             ['as' => 'admin_route_delete_product_from_user_cart', 'filter' => 'AdminFilter:add_order']);
    });

    $routes->group('users', function($routes)
    {
        $routes->get('list-select2',  'UserController::listUserSelect2',        ['as' => 'admin_route_list_users_select2', 'filter' => 'AdminFilter:view_user']);
        $routes->get('create',        'UserController::create',                 ['as' => 'admin_route_create_user', 'filter' => 'AdminFilter:add_user']);
        $routes->post('save',         'UserController::save',                   ['as' => 'admin_route_save_user', 'filter' => 'AdminFilter:add_user']);
        $routes->post('ban',          'UserController::ban',                    ['as' => 'admin_route_ban_user', 'filter' => 'AdminFilter:update_user']);
        $routes->get('(:num)/unban',  'UserController::unban/$1',               ['as' => 'admin_route_unban_user', 'filter' => 'AdminFilter:update_user']);
        $routes->get('(:num)/edit',   'UserController::edit/$1',                ['as' => 'admin_route_edit_user', 'filter' => 'AdminFilter:update_user']);
        $routes->post('(:num)/update','UserController::update/$1',              ['as' => 'admin_route_update_user', 'filter' => 'AdminFilter:update_user']);
        $routes->get('(:num)/verify', 'UserController::markEmailAsVerified/$1', ['as' => 'admin_route_verify_user', 'filter' => 'AdminFilter:update_user']);
        $routes->get('(:num)/delete', 'UserController::delete/$1',              ['as' => 'admin_route_delete_user', 'filter' => 'AdminFilter:delete_user']);
        $routes->get('(:num)/view',   'UserController::view/$1',                ['as' => 'admin_route_view_user', 'filter' => 'AdminFilter:view_user']);
        $routes->get('(:any)',        'UserController::index/$1',               ['as' => 'admin_route_users', 'filter' => 'AdminFilter:view_user']);
    });
    
});








/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
