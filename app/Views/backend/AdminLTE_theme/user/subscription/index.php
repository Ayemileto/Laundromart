   <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
<?php
    use CodeIgniter\I18n\Time;
    foreach($subscriptions as $subscription):
?>
                <div class="col-md-4 ">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <h6 class="pl-3 pt-3 fs-14">Subscription </h6>
                                </div>
                                <div>
                                    <a href="#" class="badge badge-primary-soft mr-3 mt-3" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>" onclick="showModal('<?=fullUrl(route_to('user_route_view_invoice', $subscription['invoice_id']))?>', `<?=lang('Site.invoice_details')?>`)">
                                        <?=lang('Site.view_invoice')?>
                                    </a>
                                    <a href="<?=fullUrl(route_to('user_route_create_subscription_order', $subscription['id']))?>" class="badge badge-primary-soft mr-3 mt-3">
                                        <?=lang('Site.create_order')?>
                                    </a>
                                </div>
                            </div>
                            <ul class="nav nav-pills flex-column">                                
                                <li>
                                    <span class="nav-link">
                                        <?=lang('Site.plan')?> 
                                        <span class="float-right">
                                            <?=$subscription['plan_name']?>
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="nav-link">
                                        <?=lang('Site.status')?>
                                        <span class="float-right">
                                            <?=lang('Site.'.$subscription['status'])?>
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="nav-link">
                                        <?=lang('Site.duration')?>
                                        <span class="float-right">
                                            <?=$subscription['duration']?>
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="nav-link">
                                        <?=lang('Site.subscription_date')?>
                                        <span class="float-right">
                                            <?=formatDate($subscription["subscription_date"])?>
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="nav-link">
                                        <?=lang('Site.expiry_date')?>
                                        <span class="float-right">
                                            <?=formatDate($subscription["expiry_date"])?>
                                            (<?=getDaysLeft($subscription["expiry_date"])?>)
                                        </span>
                                        </span>
                                    </span>
                                </li>
                                <!-- <li>
                                    <span class="nav-link">
                                        <?=lang('Site.renewal_date')?>
                                        <span class="float-right">
                                            <?=formatDate($subscription["renewal_date"])?>
                                        </span>
                                    </span>
                                </li> -->
                                <li>
                                    <span class="nav-link">
                                        <?=lang('Site.orders_per_month_with_date', ['date' => date('d', strtotime($subscription["subscription_date"]))])?>
                                        <span class="float-right">
                                            <?php 
                                            if($subscription['orders_per_month'] == 0):
                                                echo lang('Site.unlimited');
                                            else:
                                                echo $subscription['orders_per_month'];
                                            endif;                                       
                                            ?> 
                                        </span>
                                    </span>
                                </li>
                                <li>
                                    <span class="nav-link">
                                        <?=lang('Site.total_orders')?>
                                        <span class="float-right">
                                            <?=$subscription['total_orders']?>
                                        </span>
                                    </span>
                                </li>
                                <!-- <li>
                                    <span class="nav-link">
                                        <?=lang('Site.available_orders_with_date', ['date' => date('d', strtotime($subscription["subscription_date"]))])?>
                                        <span class="float-right">
                                            <?php 
                                            if($subscription['orders_per_month'] == 0):
                                                echo lang('Site.unlimited');
                                            else:
                                                echo $subscription['orders_per_month'] - $subscription['total_orders'];
                                            endif;                                       
                                            ?>
                                        </span>
                                    </span>
                                </li> -->
                            </ul>
                        </div>
                        
                    </div>
                </div>
<?php
endforeach;
?>
            </div>
            <div class="d-flex justify-content-center">
                <?= $pager->links() ?>
            </div>
        </div>
    </div>


<?=view('includes/js/modal')?>