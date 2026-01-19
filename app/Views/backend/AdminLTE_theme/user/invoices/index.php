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
                                        <th><?=lang('Site.total_price')?></th>
                                        <th><?=lang('Site.tax')?></th>
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
                                            <a href="<?=fullUrl(route_to('user_route_view_invoice', $invoice_id))?>" target="_blank" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                <?=$invoice['reference']?>
                                            </a>
                                        </td>
                                        <td><?=formatMoney($invoice['total_price'])?></td>
                                        <td><?=formatMoney($invoice['tax'])?></td>
                                        <td>
                                            <?=lang('Site.'.$invoice['status'])?>
                                        </td>
                                        <td>
                                            <a href="<?=fullUrl(route_to('user_route_view_invoice', $invoice_id))?>" target="_blank" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                <i class='fas fa-eye'></i>
                                            </a>
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