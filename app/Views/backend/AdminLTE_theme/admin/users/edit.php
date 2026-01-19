<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_update_user', $user['id']))?>" id="edit-user">
        <input class="form-control" type="hidden" name="id" id="id" value="<?=$user['id']?>">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="firstname"><?=lang("Auth.firstname")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="firstname" type="text" maxlength="255" id="firstname" value="<?=$user['firstname']?>">
                    <sub class="error_field text-danger" id="firstname_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="lastname"><?=lang("Auth.lastname")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="lastname" type="text" maxlength="255" id="lastname" value="<?=$user['lastname']?>">
                    <sub class="error_field text-danger" id="lastname_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="username"><?=lang("Auth.username")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="username" type="text" maxlength="255" id="username" value="<?=$user['username']?>">
                    <sub class="error_field text-danger" id="username_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="email"><?=lang("Auth.email")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="email" type="text" maxlength="255" id="email" value="<?=$user['email']?>">
                    <sub class="error_field text-danger" id="email_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="phone"><?=lang("Auth.phone")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="phone" type="text" maxlength="255" id="phone" value="<?=$user['phone']?>">
                    <sub class="error_field text-danger" id="phone_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="status"><?=lang("Site.status")?></label>
                </div>
                <div class="col-12 col-md-10">
                    <select class="form-control" name="status">
                        <option value="active" <?=$user['status'] == 'active' ? 'selected' : ''?>><?=lang("Site.active")?></option>
                        <option value="inactive" <?=$user['status'] == 'inactive' ? 'selected' : ''?>><?=lang("Site.inactive")?></option>
                    </select>
                    <sub class="error_field text-danger" id="status_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="is_banned"><?=lang("Site.is_banned")?></label>
                </div>
                <div class="col-12 col-md-10">
                    <select class="form-control" name="is_banned">
                        <option value="yes" <?=$user['is_banned'] == 'yes' ? 'selected' : ''?>><?=lang("Site.yes")?></option>
                        <option value="no" <?=$user['is_banned'] == 'no' ? 'selected' : ''?>><?=lang("Site.no")?></option>
                    </select>
                    <sub class="error_field text-danger" id="is_banned_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <span id="success" class="float-right"></span>
            <span class="text-danger error_field" id="error_error"></span>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.close")?></button>
            <button type="submit" class="btn btn-primary" id="form-submit" onclick="submitForm('edit-user')"><?=lang("Site.update")?></button>
        </div>
    </form>
</div>

<?=view('includes/js/form')?>