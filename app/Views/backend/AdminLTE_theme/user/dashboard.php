    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h4><?=$active_orders?> (<?=formatMoney($active_orders_value)?>)</h4>
                            <p><?=lang('Site.active_orders')?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('user_route_orders', 'active'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4><?=$active_subscriptions?> (<?=formatMoney($active_subscriptions_value)?>)</h4>
                            <p><?=lang('Site.active_subscriptions')?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('user_route_subscriptions', 'active'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-maroon">
                        <div class="inner">
                            <h4><?=$expiring_subscriptions?> (<?=formatMoney($expiring_subscriptions_value)?>)</h4>
                            <p><?=lang("Site.expiring_subscriptions")?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('user_route_subscriptions', 'expiring'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                                
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-navy">
                        <div class="inner">
                            <h4><?=$pending_pickups_or_delivery?></h4>
                            <p><?=lang('Site.pending_pickup_or_delivery')?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('user_route_pickups', 'pending'))?>" class="small-box-footer col-6"><?=lang('Site.pickups')?> <i class="fas fa-arrow-circle-right"></i></a>
                    <a href="<?=fullUrl(route_to('user_route_deliveries', 'pending'))?>" class="small-box-footer col-6 float-right" style="margin-top:-30px;"><?=lang('Site.deliveries')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title"><?=lang('Site.my_orders')?></h3>

                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th><?=lang('Site.id')?></th>
                                            <th><?=lang('Site.status')?></th>
                                            <th><?=lang('Site.total_due')?></th>
                                            <th><?=lang('Site.payment_status')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php
    foreach($latest_orders AS $order):
    ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('user_route_order_details', $order['id']))?>', 'Order Details')">
                                                    <?=$order["id"]?>
                                                </a>
                                            </td>
                                            <td><?=lang('Site.'.$order['status'])?></td>
                                            <td><?=formatMoney($order['total_due'])?></td>
                                            <td>
                                            <?php
                                                if(!empty($order['invoice_id'])):
                                            ?>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('user_route_view_invoice', $order['invoice_id']))?>', `<?=lang('Site.invoice_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                    <?=lang('Site.'.$order['payment_status'])?>
                                                </a>
                                            <?php
                                                elseif(!empty($order['subscription_id'])):
                                            ?>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('user_route_subscription_details', $order['subscription_id']))?>', `<?=lang('Site.subscription_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.subscription_details')?>">
                                                    <?=lang('Site.subscription')?>
                                                </a>
                                            <?php
                                                endif;
                                            ?>
                                            </td>
                                        </tr>
    <?php
    endforeach;
    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="<?=fullUrl(route_to('user_route_cart'))?>" class="btn btn-sm btn-info float-left"><?=lang("Site.place_new_order")?></a>
                            <a href="<?=fullUrl(route_to('user_route_orders', 'all'))?>" class="btn btn-sm btn-secondary float-right"><?=lang("Site.view_all_orders")?></a>
                        </div>
                    <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->

                    <!-- TABLE: LATEST SUBSCRIPTIONS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title"><?=lang('Site.my_subscriptions')?></h3>

                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th><?=lang('Site.id')?></th>
                                            <th><?=lang('Site.plan')?></th>
                                            <th><?=lang('Site.status')?></th>
                                            <th><?=lang('Site.total_due')?></th>
                                            <th><?=lang('Site.payment_status')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php
    foreach($latest_subscriptions AS $subscription):
    ?>
                                        <tr>
                                            <td>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('user_route_subscription_details', $subscription['id']));?>', `<?=lang('Site.subscription_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.subscription_details')?>">
                                                    <?=$subscription['id']?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('user_route_view_plan', $subscription['plan_id']))?>', `<?=lang('Site.plan_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.plan_details')?>">
                                                    <?=$subscription['plan_name']?>
                                                </a>
                                                <br> <sub>(<?=lang('Site.'.$subscription['duration'])?>)</sub>
                                            </td>
                                            <td><?=lang('Site.'.$subscription['status'])?></td>
                                            <td><?=formatMoney($subscription['total_due'])?></td>
                                            <td>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('user_route_view_invoice', $subscription['invoice_id']))?>', `<?=lang('Site.invoice_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                    <?=lang('Site.'.$subscription['payment_status'])?>
                                                </a>
                                            </td>
                                        </tr>
    <?php
    endforeach;
    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="<?=fullUrl(route_to('plans'))?>" class="btn btn-sm btn-info float-left"><?=lang("Site.new_subscription")?></a>
                            <a href="<?=fullUrl(route_to('user_route_subscriptions', 'all'))?>" class="btn btn-sm btn-secondary float-right"><?=lang("Site.view_all_subscriptions")?></a>
                        </div>
                    <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <!-- PRODUCT LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=lang('Site.my_invoices')?></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
<?php 
$i = 1;
foreach($latest_invoices AS $invoice): 
    $invoice_id     = $invoice['id'];
    
    if($invoice['status']=='unpaid'):
        $badge_color = "badge-info";
    elseif($invoice['status']=='cancelled'):
        $badge_color = "badge-warning";
    elseif($invoice['status']=='failed'):
        $badge_color = "badge-danger";
    elseif($invoice['status']=='paid'):
        $badge_color = "badge-success";
    else:
        $badge_color = "badge-dark";
    endif;

$i++;
?>

                                <li class="item">
                                    <div class="product-info ml-0">
                                    <a href="<?=fullUrl(route_to('user_route_view_invoice', $invoice_id))?>" target="_blank" class="product-title"><?=$invoice["reference"]?>
                                        <span class="badge <?=$badge_color?> float-right"><?=formatMoney($invoice['total_due'])?></span></a>
                                    <span class="product-description">
                                        <?=lang('Site.'.$invoice['status'])?>
                                    </span>
                                    </div>
                                </li>
<?php endforeach ?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="<?=fullUrl(route_to('user_route_invoices', 'all'))?>" class="text-uppercase"><?=lang('Site.invoices')?></a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<?=view('includes/js/modal')?>