<div class="my-2">

    <form method="post" action="<?=fullUrl(route_to('admin_route_update_staff', $staff['id']))?>" id="edit_staff_form">
        <div class="card-body">
            <div class="form-group">
                <input type="hidden" name="id" value="<?=$staff['id']?>">
                <label for="firstname"><?=lang('Auth.fields.firstname')?></label>
                <input type="text" name="firstname" class="form-control" maxlength="50" placeholder="<?=lang('Auth.fields.firstname')?>" value="<?=$staff['firstname']?>" required>
                <sub class="form-text text-danger error_field" id="firstname_error"></sub>
            </div>
            <div class="form-group">
                <label for="lastname"><?=lang('Auth.fields.lastname')?></label>
                <input type="text" name="lastname" class="form-control" maxlength="50" placeholder="<?=lang('Auth.fields.lastname')?>" value="<?=$staff['lastname']?>" required>
                <sub class="form-text text-danger error_field" id="lastname_error"></sub>
            </div>
            <div class="form-group">
                <label for="email"><?=lang('Auth.fields.email')?></label>
                <input type="email" name="email" class="form-control" maxlength="255" placeholder="<?=lang('Auth.fields.email')?>" value="<?=$staff['email']?>" required>
                <sub class="form-text text-danger error_field" id="email_error"></sub>
            </div>
            <div class="form-group">
                <label for="phone"><?=lang('Auth.fields.phone')?></label>
                <input type="text" name="phone" class="form-control" maxlength="15" placeholder="<?=lang('Auth.fields.phone')?>" value="<?=$staff['phone']?>" required>
                <sub class="form-text text-danger error_field" id="phone_error"></sub>
            </div>
            <div class="form-group">
                <label for="role"><?=lang('Site.role')?></label>
                <select name="role" class="form-control" required>
                    <option value=""></option>
<?php
    foreach($roles AS $role)
    {
?>
                    <option value="<?=$role["id"]?>" <?=$staff['role_id'] == $role['id']? 'selected' : ''?>><?=$role["name"]?></option>
<?php
    }
?>
                </select>
                <sub class="form-text text-danger error_field" id="role_error"></sub>
            </div>
            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('edit_staff_form')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view("includes/js/form")?>
<?=view("includes/js/select2")?>