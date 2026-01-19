<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_save_user'))?>" id="create-user">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="firstname"><?=lang("Auth.firstname")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="firstname" type="text" maxlength="255" id="firstname" value="" required>
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
                    <input class="form-control" name="lastname" type="text" maxlength="255" id="lastname" value="" required>
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
                    <input class="form-control" name="username" type="text" maxlength="255" id="username" value="" required>
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
                    <input class="form-control" name="email" type="text" maxlength="255" id="email" value="" required>
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
                    <input class="form-control" name="phone" type="text" maxlength="255" id="phone" value="" required>
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
                        <option value="active" selected><?=lang("Site.active")?></option>
                        <option value="inactive"><?=lang("Site.inactive")?></option>
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
                        <option value="yes"><?=lang("Site.yes")?></option>
                        <option value="no" selected><?=lang("Site.no")?></option>
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
            <button type="submit" class="btn btn-primary" id="form-submit" onclick="submitForm('create-user')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view('includes/js/form')?>