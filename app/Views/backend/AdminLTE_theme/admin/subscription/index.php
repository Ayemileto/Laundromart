<?=view("includes/css/table");?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
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
                                    <th><?=lang('Site.subscriber')?></th>
                                    <th><?=lang('Site.plan')?></th>
                                    <th><?=lang('Site.payment_status')?></th>
                                    <th><?=lang('Site.status')?></th>
                                    <th><?=lang('Site.subscription_date')?></th>
                                    <th><?=lang('Site.renewal_date')?></th>
                                    <th><?=lang('Site.expiry_date')?></th>
                                    <th><?=lang('Site.actions')?></th>
                                </tr>
                                </thead>
                                <tbody>
<?php
use CodeIgniter\I18n\Time;
    foreach($subscriptions as $subscription):
        $subscription_date = formatDate($subscription["subscription_date"]);
        $renewal_date = formatDate($subscription["renewal_date"]);
        $expiry_date = formatDate($subscription["expiry_date"]);
?>
                                    <tr>
                                        <td><?=$subscription['id']?></td>                                       
                                        <td><a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_user', $subscription['user_id']))?>', `<?=lang('Site.user_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.user_details')?>"><?=$subscription['subscriber_name']?></a></td>
                                        <td><a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_plan', $subscription['plan_id']))?>', `<?=lang('Site.plan_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.plan_details')?>"><?=$subscription['plan_name']?></a></td>
                                        <td>
                                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_invoice', $subscription['invoice_id']))?>', `<?=lang('Site.invoice_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                                <?=lang('Site.'.$subscription['payment_status'])?>
                                            </a>
                                        </td>
                                        <td><?=lang('Site.'.$subscription['status'])?></td>
                                        <td><?=$subscription_date;?></td>
                                        <td><?=$renewal_date;?></td>
                                        <td><?=$expiry_date;?></td>
                                        <td>
                                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_subscription_details', $subscription['id']));?>', `<?=lang('Site.subscription_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.subscription_details')?>"><i class="fas fa-eye mr-1"></i></a>
                                            <a href="#" data-href="<?=base_url().route_to("delete_subscription_admin", $subscription['id']);?>" data-action="delete" class="btn_action" data-toggle="tooltip" title="<?=lang('Site.delete_subscription')?>"><i class="fas fa-trash text-danger mr-1"></i></a>
                                        </td>
                                    </tr>
<?php
endforeach;
?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><?=lang('Site.id')?></th>
                                        <th><?=lang('Site.subscriber')?></th>
                                        <th><?=lang('Site.plan')?></th>
                                        <th><?=lang('Site.invoice_id')?></th>
                                        <th><?=lang('Site.status')?></th>
                                        <th><?=lang('Site.subscription_date')?></th>
                                        <th><?=lang('Site.renewal_date')?></th>
                                        <th><?=lang('Site.expiry_date')?></th>
                                        <th><?=lang('Site.actions')?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            <?= $pager->links() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?=view("includes/js/table");?>
<?=view('includes/js/modal')?>
