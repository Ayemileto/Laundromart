<?=view('includes/css/table')?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=$title?></h3>
                            <?php if(has_permission('add_invoice')): ?>
                            <a href="<?=fullUrl(route_to('admin_route_create_invoice'))?>" class="btn btn-primary float-right"><?=lang('Site.create_invoice')?></a>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped use-datatable">
                                <thead>
                                    <tr>
                                        <th><?=lang('Site.id')?></th>
                                        <th><?=lang('Site.customer_name')?></th>
                                        <th><?=lang('Site.total_price')?></th>
                                        <th><?=lang('Site.tax')?></th>
                                        <th><?=lang('Site.total_due')?></th>
                                        <th><?=lang('Site.status')?></th>
                                        <th><?=lang('Site.action')?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    foreach($invoices as $invoice):
        $invoice_id     = $invoice['id'];
?>
                                    <tr>
                                        <td>
                                            <a href="<?=fullUrl(route_to('admin_route_view_invoice', $invoice_id))?>" target="_blank" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                <?=$invoice['reference']?>
                                            </a>
                                        </td>
                                        <td><a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_user', $invoice['user_id']))?>', `<?=lang('Site.user_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.user_details')?>"><?=$invoice['customer_name']?></a></td>
                                        <td><?=formatMoney($invoice['total_price'])?></td>
                                        <td><?=formatMoney($invoice['tax'])?></td>
                                        <td><?=formatMoney($invoice['total_due'])?></td>
                                        <td>
                                            <?=lang('Site.'.$invoice['status'])?>
                                        </td>
                                        <td>
                                            <a href="<?=fullUrl(route_to('admin_route_view_invoice', $invoice_id))?>" target="_blank" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                <i class='fas fa-eye'></i>
                                            </a>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_add_item_to_invoice', $invoice_id))?>', '<?=lang('Site.add_item_to_invoice')?>')" data-toggle="tooltip" title="<?=lang('Site.add_item_to_invoice')?>">
                                                <i class='fas fa-plus'></i>
                                            </a>
<?php
    if($invoice['status'] == 'unpaid' && has_permission('update_invoice')):
?>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_mark_invoice_as_paid', $invoice_id))?>', '<?=lang('Site.mark_invoice_as_paid')?>')" data-toggle="tooltip" title="<?=lang('Site.mark_invoice_as_paid')?>">
                                                <i class='fas fa-check text-teal'></i>
                                            </a>
<?php
    endif;
    if($invoice['status'] == 'paid' && has_permission('update_invoice')):
?>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_payment_cancel', $invoice_id))?>', '<?=lang('Site.cancel_payment')?>')" data-toggle="tooltip" title="<?=lang('Site.cancel_payment')?>">
                                                <i class='fas fa-times text-danger'></i>
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