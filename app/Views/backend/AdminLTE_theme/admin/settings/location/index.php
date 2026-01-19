    <style>
    iframe {
        width: 250px!important;
        height: 200px!important;
    }
    </style>
    <?=view('includes/css/table')?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#officeBranchesSettings" data-toggle="tab"><?=lang("Site.office_branches")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#locationSettings" data-toggle="tab"><?=lang("Site.pickup_delivery_locations")?></a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="officeBranchesSettings">
                                    <button class="btn btn-outline-primary float-right" onclick="showModal('<?=fullUrl(route_to('admin_route_add_branch'))?>', `<?=lang('Site.add_branch')?>`)"><?=lang('Site.add_branch')?></button>
                                    <table class="table-striped table-bordered col-12 use-datatable">
                                        <thead>
                                            <tr>
                                                <th><?=lang('Site.zipcode')?></th>
                                                <th><?=lang('Site.address')?></th>
                                                <th><?=lang('Site.phone')?></th>
                                                <th><?=lang('Site.google_map_location')?></th>
                                                <th><?=lang('Site.status')?></th>
                                                <th><?=lang('Site.show_on_homepage')?></th>
                                                <th><?=lang('Site.show_on_contact_page')?></th>
                                                <th><?=lang('Site.actions')?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
    foreach($office_branches as $branch):
?>
                                            <tr>
                                                <td><?=$branch['zipcode']?></td>
                                                <td><?=$branch['office_address']?></td>
                                                <td><?=$branch['office_phone']?></td>
                                                <td class="text-center p-3"><?=$branch['google_map_location']?></td>
                                                <td><?=$branch['status'] == 'active' ? lang('Site.active') : lang('Site.inactive')?></td>
                                                <td><?=$branch['show_on_homepage']?></td>
                                                <td><?=$branch['show_on_contact_page']?></td>
                                                <td>
                                                    <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_branch', $branch['id']))?>', '<?=lang('Site.edit_branch')?>')" class="btn btn-sm bg-teal" data-toggle="tooltip" title="<?=lang('Site.edit_branch')?>">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="#" id="delete_branch_btn_<?=$branch['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_branch', $branch['id']))?>', this.id, true, '', 'tr', 'bg-danger')" class="btn btn-sm bg-danger" data-toggle="tooltip" title="<?=lang("Site.delete_branch")?>">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
<?php
    endforeach;
?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><?=lang('Site.zipcode')?></th>
                                                <th><?=lang('Site.address')?></th>
                                                <th><?=lang('Site.phone')?></th>
                                                <th><?=lang('Site.google_map_location')?></th>
                                                <th><?=lang('Site.status')?></th>
                                                <th><?=lang('Site.show_on_homepage')?></th>
                                                <th><?=lang('Site.show_on_contact_page')?></th>
                                                <th><?=lang('Site.actions')?></th>
                                            </tr>
                                        </tfoot>
                                    </table>                                
                                </div>


                                <div class="tab-pane" id="locationSettings">
                                    <button class="btn btn-outline-primary float-right" onclick="showModal('<?=fullUrl(route_to('admin_route_add_location'))?>', `<?=lang('Site.add_location')?>`)"><?=lang('Site.add_location')?></button>
                                    <table class="table-striped table-bordered col-12 use-datatable">
                                        <thead>
                                            <tr>
                                                <th><?=lang('Site.name')?></th>
                                                <th><?=lang('Site.zipcode')?></th>
                                                <th><?=lang('Site.pickup_only_price')?></th>
                                                <th><?=lang('Site.delivery_only_price')?></th>
                                                <th><?=lang('Site.pickup_delivery_price')?></th>
                                                <th><?=lang('Site.status')?></th>
                                                <th><?=lang('Site.actions')?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
    foreach($locations as $location):
?>
                                            <tr>
                                                <td><?=$location['name']?></td>
                                                <td><?=$location['zipcode']?></td>
                                                <td><?=$location['pickup_only_price']?></td>
                                                <td><?=$location['delivery_only_price']?></td>
                                                <td><?=$location['pickup_delivery_price']?></td>
                                                <td><?=$location['status'] == 'active' ? lang('Site.active') : lang('Site.inactive')?></td>
                                                <td>
                                                    <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_location', $location['id']))?>', '<?=lang('Site.edit_branch')?>')" class="btn btn-sm bg-teal" data-toggle="tooltip" title="<?=lang('Site.edit_branch')?>">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="#" id="delete_location_btn_<?=$location['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_branch', $location['id']))?>', this.id, true, '', 'tr', 'bg-danger')" class="btn btn-sm bg-danger" data-toggle="tooltip" title="<?=lang("Site.delete_location")?>">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
<?php
    endforeach;
?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><?=lang('Site.name')?></th>
                                                <th><?=lang('Site.zipcode')?></th>
                                                <th><?=lang('Site.pickup_only_price')?></th>
                                                <th><?=lang('Site.delivery_only_price')?></th>
                                                <th><?=lang('Site.pickup_delivery_price')?></th>
                                                <th><?=lang('Site.status')?></th>
                                                <th><?=lang('Site.actions')?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?=view('includes/js/modal')?>
    <?=view('includes/js/table')?>