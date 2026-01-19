    <?=view('includes/css/table')?>
 
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=$title?></h3>
                            <span class="float-sm-right"><button class="btn btn-primary" onclick="showModal('<?=base_url().route_to('admin_route_add_product_services')?>', '<?=lang('Site.add_service')?>')"><?=lang('Site.add_service')?></button></span>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped use-datatable">
                                <thead>
                                    <tr>
                                        <th><?=lang('Site.service_name')?></th>
                                        <th><?=lang('Site.actions')?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    foreach($product_services as $service):
?>
                                    <tr>
                                        <td><?=$service['name']?></td>
                                        <td>
                                            <a href="#" class="mx-2" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_product_services', $service['id']))?>', '<?='Site.edit_service'?>')"><i class='fas fa-pen'></i></a>
                                            <a href="#" class="mx-2" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_product_services', $service['id']))?>', this.id, true, '', 'tr', 'btn-danger')"><i class='fas fa-trash text-danger'></i></a>
                                        </td>
                                    </tr>
<?php
    endforeach;
?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?=view('includes/js/modal')?>
    <?=view('includes/js/table')?>
