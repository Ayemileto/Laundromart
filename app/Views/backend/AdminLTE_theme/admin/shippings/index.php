<?=view('includes/css/table')?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=$title?></h3>
<?php
    if(has_permission('add_order')):
?>
                            <a href="<?=fullUrl(route_to('admin_route_create_order'))?>" class="btn btn-primary float-right"><?=lang('Site.create_order')?></a>
<?php
    endif;
?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped use-datatable">
                                <thead>
                                    <tr>
                                        <th><?=lang('Site.id')?></th>
                                        <th><?=lang('Site.customer_name')?></th>
                                        <th><?=lang('Site.location')?></th>
                                        <th><?=lang('Site.pickup_date')?></th>
                                        <th><?=lang('Site.pickup_status')?></th>
                                        <th><?=lang('Site.delivery_date')?></th>
                                        <th><?=lang('Site.delivery_status')?></th>
                                        <th><?=lang('Site.action')?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    foreach($shippings as $shipping):
        $shipping_id     = $shipping['id'];
?>
                                    <tr>
                                        <td><?=$shipping_id?></td>
                                        <td><a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_user', $shipping['user_id']))?>', `<?=lang('Site.user_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.user_details')?>"><?=$shipping['customer_name']?></a></td>
                                        <td><?=$shipping['location_zipcode']?></td>
                                        <td><?=formatDate($shipping['pickup_date']).' '.formatTime($shipping['pickup_time'])?></td>
                                        <td><?=lang('Site.'.$shipping['pickup_status'])?></td>
                                        <td><?=formatDate($shipping['delivery_date']).' '.formatTime($shipping['delivery_time'])?></td>
                                        <td><?=lang('Site.'.$shipping['delivery_status'])?></td>
                                        <td>
                                <?php
                                    if(has_permission('view_order')):
                                ?>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_order_details', $shipping['order_id']))?>', 'Order Details')"><i class='fas fa-eye'></i></a>
                                <?php
                                    endif;
                                    if(has_permission('update_shipping')):
                                        if($shipping['pickup_status'] != 'completed'):
                                ?>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_shipping', $shipping['id']))?>', '<?=lang('Site.edit_shipping')?>')"><i class='fas fa-eye'></i></a>
                                            <a href="#" id='mark_pickup_as_complete_<?=$shipping_id?>' class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_mark_pickup_as_complete', $shipping_id))?>', this.id, true, '', 'tr', 'btn-teal')" data-toggle="tooltip" title="<?=lang("Site.mark_pickup_as_pickup_completed")?>"><i class='fas fa-check text-success'></i></a>
                                <?php
                                            if($shipping['pickup_status'] == 'pending'):
                                ?>
                                                <a href="#" id='mark_pickup_as_failed_<?=$shipping_id?>' class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_mrk_pickup_as_failed', $shipping_id))?>', this.id, true, '', 'tr', 'btn-danger')" data-toggle="tooltip" title="<?=lang("Site.mark_pickup_as_failed")?>"><i class='fas fa-times text-danger'></i></a>
                                <?php
                                            endif;
                                        endif;
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