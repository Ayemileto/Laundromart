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
                                        <th><?=lang('Site.location')?></th>
                                        <th><?=lang('Site.pickup_date')?></th>
                                        <th><?=lang('Site.status')?></th>
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
                                        <td><?=$shipping['location_zipcode']?></td>
                                        <td><?=formatDate($shipping['pickup_date']).' '.formatTime($shipping['pickup_time'])?></td>
                                        <td><?=lang('Site.'.$shipping['pickup_status'])?></td>
                                        <td>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('user_route_order_details', $shipping['order_id']))?>', '<?=lang('Site.order_details')?>')" data-toggle="tooltip" title="<?=lang('Site.order_details')?>"><i class='fas fa-eye'></i></a>
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