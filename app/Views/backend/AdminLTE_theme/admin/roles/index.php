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
                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_add_role'))?>', `<?=lang('Site.add_role')?>`)" class="btn btn-primary float-right"><?=lang("Site.add_role")?></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped use-datatable">
                                <thead>
                                <tr>
                                    <th><?=lang("Site.role")?></th>
                                    <th><?=lang("Site.permissions")?></th>
                                    <th><?=lang("Site.actions")?></th>
                                </tr>
                                </thead>
                                <tbody>
<?php
    foreach($roles as $role):
?>
                                    <tr>
                                        <td><?=$role['name']?></td>
                                        <td>
<?php
        $permissions = explode(',', $role['permissions']);

        foreach($permissions AS $permission):
                                            echo lang("Permission.$permission").'<br>';
        endforeach;
?>                                        
                                        </td>
                                        <td>
                                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_role', $role['id']))?>', '<?=lang('Site.edit_role')?>')" data-toggle="tooltip" title="<?=lang("Site.edit_role")?>"><i class="fas fa-pen mr-1"></i></a>
                                            <a href="#" id="delete_btn_<?=$role['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_role', $role['id']))?>', this.id, true, '', 'tr', 'bg-danger')" class="mx-2" data-toggle="tooltip" title="<?=lang("Site.delete_role")?>">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
<?php
endforeach;
?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><?=lang("Site.role")?></th>
                                        <th><?=lang("Site.permissions")?></th>
                                        <th><?=lang("Site.actions")?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<?=view("includes/js/table");?>
<?=view("includes/js/modal");?>