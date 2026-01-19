    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
<?php
    if(has_permission('view_order')):
?>
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
                    <a href="<?=fullUrl(route_to('admin_route_orders', 'active'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h4><?=$pending_orders?> (<?=formatMoney($pending_orders_value)?>)</h4>
                            <p><?=lang('Site.pending_orders')?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('admin_route_orders', 'pending'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
<?php
    endif;
    if(has_permission('view_shipping')):
?>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-navy">
                        <div class="inner">
                            <h4><?=$pending_pickups?></h4>
                            <p><?=lang('Site.pending_pickups')?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('admin_route_pickups', 'pending'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h4><?=$pending_deliveries?></h4>
                            <p><?=lang('Site.pending_deliveries')?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('admin_route_deliveries', 'pending'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
<?php
    endif;
    if(has_permission('view_subscription')):
?>
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
                    <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'active'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h4><?=$pending_subscriptions?> (<?=formatMoney($pending_subscriptions_value)?>)</h4>
                            <p><?=lang('Site.pending_subscriptions')?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'pending'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'expiring'))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
<?php
    endif;
    
    if(has_permission('view_statistic')):
?>
                <div class="col-lg-3 col-12">
                    <!-- small box -->
                    <div class="small-box bg-gray-dark">
                        <div class="inner">
                            <h4><?=$todays_visitors?></h4>
                            <p><?=lang('Site.todays_visitors')?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?=fullUrl(route_to("admin_route_analytics", "visitors"))?>" class="small-box-footer"><?=lang('Site.more_info')?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
<?php endif; ?>
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
<?php
    if(has_permission('view_order') || has_permission('view_subscription')):
?>
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
    <?php
        if(has_permission('view_order')):
    ?>
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title"><?=lang('Site.latest_orders')?></h3>

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
                                            <th><?=lang('Auth.username')?></th>
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
                                                <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_order_details', $order['id']))?>', 'Order Details')">
                                                    <?=$order["id"]?>
                                                </a>
                                            </td>
                                            <td><a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_user', $order['user_id']))?>', `<?=lang('Site.user_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.user_details')?>"><?=$order['username']?></a></td>
                                            <td><?=lang('Site.'.$order['status'])?></td>
                                            <td><?=formatMoney($order['total_due'])?></td>
                                            <td>
                                            <?php
                                                if(!empty($order['invoice_id'])):
                                            ?>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_invoice', $order['invoice_id']))?>', `<?=lang('Site.invoice_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                    <?=lang('Site.'.$order['payment_status'])?>
                                                </a>
                                            <?php
                                                elseif(!empty($order['subscription_id'])):
                                            ?>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_subscription_details', $order['subscription_id']))?>', `<?=lang('Site.subscription_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.subscription_details')?>">
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
    <?php
        if(has_permission('add_order')):
    ?>
                            <a href="<?=fullUrl(route_to('admin_route_create_order'))?>" class="btn btn-sm btn-info float-left"><?=lang("Site.place_new_order")?></a>
    <?php
        endif;
    ?>
                            <a href="<?=fullUrl(route_to('admin_route_orders', 'all'))?>" class="btn btn-sm btn-secondary float-right"><?=lang("Site.view_all_orders")?></a>
                        </div>
                    <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
    <?php
        endif;

        if(has_permission('view_subscription')):
    ?>
                    <!-- TABLE: LATEST SUBSCRIPTIONS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title"><?=lang('Site.latest_subscriptions')?></h3>

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
                                            <th><?=lang('Auth.username')?></th>
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
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_subscription_details', $subscription['id']));?>', `<?=lang('Site.subscription_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.subscription_details')?>">
                                                    <?=$subscription['id']?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_user', $subscription['user_id']))?>', `<?=lang('Site.user_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.user_details')?>">
                                                    <?=$subscription['username']?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_plan', $subscription['plan_id']))?>', `<?=lang('Site.plan_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.plan_details')?>">
                                                    <?=$subscription['plan_name']?>
                                                </a>
                                                <br> <sub>(<?=lang('Site.'.$subscription['duration'])?>)</sub>
                                            </td>
                                            <td><?=lang('Site.'.$subscription['status'])?></td>
                                            <td><?=formatMoney($subscription['total_due'])?></td>
                                            <td>
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_invoice', $subscription['invoice_id']))?>', `<?=lang('Site.invoice_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
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
                            <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'all'))?>" class="btn btn-sm btn-secondary float-right"><?=lang("Site.view_all_subscriptions")?></a>
                        </div>
                    <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
    <?php
        endif;
    ?>
                </div>
                <!-- /.col -->
<?php
    endif;
    if(has_permission('view_product')):
?>
                <div class="col-md-4">
                    <!-- PRODUCT LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=lang('Site.recently_added_products')?></h3>

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
foreach($latest_products AS $product): 
    
    $price = getProductPriceRange($product['prices']);
    if($i==1):
        $badge_color = "badge-warning";
    elseif($i==2):
        $badge_color = "badge-info";
    elseif($i==3):
        $badge_color = "badge-danger";
    elseif($i==4):
        $badge_color = "badge-success";
    else:
        $badge_color = "badge-dark";
        $i = 0;
    endif;

$i++;
?>

                                <li class="item">
                                    <div class="product-img">
                                    <img src="<?=showProductImage($product["file"])?>" alt="Product Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"><?=$product["name"]?>
                                        <span class="badge <?=$badge_color?> float-right"><?=$price?></span></a>
                                    <span class="product-description">
                                    <?=$product["description"]?>
                                    </span>
                                    </div>
                                </li>
<?php endforeach ?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="<?=fullUrl(route_to("admin_route_list_product"))?>" class="text-uppercase"><?=lang('Site.all_products')?></a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
<?php endif; ?>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

<?=view('includes/js/modal')?>