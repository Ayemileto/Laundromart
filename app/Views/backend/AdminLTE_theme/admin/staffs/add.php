<?=view("includes/css/select2")?>
<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_save_staff'))?>" id="add_staff_form">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="email"><?=lang('Auth.email')?></label>
                </div>
                <div class="col-12 col-md-10">
                    <select name="user_id" id="user_id" class="form-control select2bs4" data-placeholder="<?=lang('Site.type_user_email_to_search')?>" data-ajax--url="<?=fullUrl(route_to('admin_route_list_users_select2'))?>">
                        <option value=""></option>
                    </select>
                    <sub class="form-text text-danger error_field" id="user_id_error"></sub>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="role"><?=lang('Site.role')?></label>
                </div>
                <div class="col-12 col-md-10">
                    <select name="role" class="form-control" required>
                        <option value=""></option>
<?php
    foreach($roles AS $role)
    {
?>
                        <option value="<?=$role["id"]?>"><?=$role["name"]?></option>
<?php
    }
?>
                  </select>
                    <sub class="form-text text-danger error_field" id="role_error"></sub>
<?php
    if(has_permission("add_roles")):
?>
                    <span class="form-text float-right"><a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_add_role'))?>', `<?=lang('Site.add_role')?>`)"><?=lang("Site.add_role")?></a></span>
<?php
    endif;
?>
                </div>
            </div>
        </div>

        <span class="text-success error_field" id="success"></span>
        <span class="text-danger error_field" id="error"></span>        

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.close")?></button>
            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('add_staff_form')"><?=lang("Site.add_staff")?></button>
        </div>
    </form>
</div>


<?=view("includes/js/form")?>
<?=view("includes/js/select2")?>