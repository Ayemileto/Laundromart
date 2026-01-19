<?=view('includes/css/table')?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=$title?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped use-datatable">
                                <thead>
                                    <tr>
                                        <th><?=lang('Site.id')?></th>
                                        <th><?=lang('Site.order_status')?></th>
                                        <th><?=lang('Site.total_price')?></th>
                                        <th><?=lang('Site.payment_status')?></th>
                                        <th><?=lang('Site.action')?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    foreach($orders as $order):
        $order_id     = $order['id'];
        $delivered_at = '';

        if(!empty($order['delivered_at']))
        {
            $delivered_at = '<br> <sub>Delivered: '. formatDateTime($order['delivered_at']).'</sub>';
        }
?>
                                    <tr>
                                        <td><?=$order_id?></td>
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
                                        <td>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('user_route_order_details', $order_id))?>', 'Order Details')"><i class='fas fa-eye'></i></a>
                                        </td>
                                    </tr>
<?php
    endforeach;
?>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <?=$pager->links()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?=view('includes/js/table')?>
<?=view('includes/js/modal')?>