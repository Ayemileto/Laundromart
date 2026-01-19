<?=view("includes/css/table");?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=lang('Site.staff_list')?></h3>
                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_add_staff'))?>', `<?=lang('Site.add_staff')?>`)" class="btn btn-primary float-right"><?=lang('Site.add_staff')?></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped use-datatable">
                                <thead>
                                <tr>
                                    <th><?=lang('Auth.firstname')?></th>
                                    <th><?=lang('Auth.lastname')?></th>
                                    <th><?=lang('Auth.email')?></th>
                                    <th><?=lang('Auth.phone')?></th>
                                    <th><?=lang('Site.role')?></th>
                                    <th><?=lang('Site.actions')?></th>
                                </tr>
                                </thead>
                                <tbody>
<?php
    foreach($staffs as $user):
?>
                                    <tr>
                                        <td class='text-break'><?=$user['firstname']?></td>
                                        <td class='text-break'><?=$user['lastname']?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?=$user['phone']?></td>
                                        <td><?=$user['is_superadmin'] == 'yes' ? lang('Site.superadmin') : $user['role']?></td>
                                        <td>
<?php
    if($user['is_superadmin'] != 'yes'):
        if(has_permission('view_staff')):
?>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_view_staff', $user['id']))?>', `<?=lang('Site.staff_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.staff_details')?>"><i class="fas fa-eye"></i></a>
<?php
        endif;
        if(has_permission('update_staff')):
?>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_staff', $user['id']))?>', `<?=lang('Site.edit_staff')?>`)" data-toggle="tooltip" title="<?=lang('Site.edit_staff')?>"><i class="fas fa-pen text-teal"></i></a>
<?php
        endif;
        if(has_permission('delete_staff')):
?>
                                            <a href="#" id="remove_staff_<?=$user['id']?>" class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_remove_staff', $user['id']))?>', this.id, true, '', 'tr', 'btn-danger', '<?=lang('Site.are_you_sure_remove_staff')?>')" data-toggle="tooltip" title="<?=lang('Site.remove_staff')?>"><i class="fas fa-minus text-danger"></i></a>
                                            <a href="#" id="delete_staff_<?=$user['id']?>" class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_staff', $user['id']))?>', this.id, true, '', 'tr', 'btn-danger', '<?=lang('Site.are_you_sure_delete_staff')?>')" data-toggle="tooltip" title="<?=lang('Site.delete_staff')?>"><i class="fas fa-trash text-danger"></i></a>
<?php
        endif;
    endif;
?>
                                        </td>
                                    </tr>
<?php
endforeach;
?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><?=lang('Auth.firstname')?></th>
                                        <th><?=lang('Auth.lastname')?></th>
                                        <th><?=lang('Auth.email')?></th>
                                        <th><?=lang('Auth.phone')?></th>
                                        <th><?=lang('Site.role')?></th>
                                        <th><?=lang('Site.actions')?></th>
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