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
                                    <th><?=lang('Auth.firstname')?></th>
                                    <th><?=lang('Auth.lastname')?></th>
                                    <th><?=lang('Auth.username')?></th>
                                    <th><?=lang('Auth.email')?></th>
                                    <th><?=lang('Site.status')?></th>
                                    <th><?=lang('Site.registration_date')?></th>
                                    <th><?=lang('Site.actions')?></th>
                                </tr>
                                </thead>
                                <tbody>
<?php
    foreach($users as $user):
?>
                                    <tr>
                                        <td><?=$user['firstname']?></td>
                                        <td><?=$user['lastname']?></td>
                                        <td><?=$user['username']?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?=lang("Site.".$user['status'])?></td>
                                        <td><?=formatDate($user["created_at"])?></td>
                                        <td>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_view_user', $user['id']))?>', `<?=lang('Site.user_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.user_details')?>"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="mx-1" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_user', $user['id']))?>', `<?=lang('Site.edit_user')?>`)" data-toggle="tooltip" title="<?=lang('Site.edit_user')?>"><i class="fas fa-pen text-teal"></i></a>
<?php
    if($user["email_verified"] == "no"):
?>
                                            <a href="#" id="verify_email_<?=$user['id']?>" class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_verify_user', $user['id']))?>', this.id, true, '', '', 'bg-olive')" data-toggle="tooltip" title="<?=lang('Site.mark_email_as_verified')?>"><i class="fas fa-check text-olive"></i></a>
<?php
    endif;
    if($user["is_banned"] == "no"):
 ?>
                                            <a href="#" data-toggle="modal" data-target="#ban-modal" data-user_id="<?=$user['id']?>" data-email="<?=$user['email']?>"><i class="fas fa-ban text-danger mr-1" data-toggle="tooltip" title="<?=lang('Site.ban_user')?>"></i></a>
<?php
    else:
?>
                                            <a href="#" id="unban_user_<?=$user['id']?>" class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_unban_user', $user['id']))?>', this.id, true, 'ban_user_<?=$user['id']?>', '', 'btn-warning')" data-toggle="tooltip" title="<?=lang('Site.unban_user')?>"><i class="fas fa-redo-alt mr-1"></i></a>
<?php
    endif;
?>
                                            <a href="#" id="delete_user_<?=$user['id']?>" class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_user', $user['id']))?>', this.id, true, '', 'tr', 'btn-danger')" data-toggle="tooltip" title="<?=lang('Site.delete_user')?>"><i class="fas fa-trash text-danger"></i></a>
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
                                        <th><?=lang('Auth.username')?></th>
                                        <th><?=lang('Auth.email')?></th>
                                        <th><?=lang('Site.status')?></th>
                                        <th><?=lang('Site.registration_date')?></th>
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



<div class="modal fade" id="ban-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="post" action="<?=base_url().route_to("ban_user_admin");?>">
                    <input type="hidden" name="user_id" value="">
                    <div class="form-group">
                        <label for="reason"><?=lang('General.ban_reason')?></label>
                        <textarea name="reason" class="form-control"></textarea>
                    </div>
                    <div class="text-success" id="success"></div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="form-submit"><?=lang('General.ban_user')?></button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#ban-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var user_id = button.data('user_id');
    var email = button.data('email');
    var modal = $(this);
    modal.find('.modal-title').html('<?=lang('General.ban')?> <span class="text-primary">' + email +'</span>');
    modal.find('.modal-body input').val(user_id)
});
</script>

<?=view("includes/js/modal");?>
<?=view("includes/js/form");?>
<?=view("includes/js/table");?>