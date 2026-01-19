    <!-- Main content -->
    <div class="content">
        <div class="container-fluid"><!--FIRST CONTAINER START-->     
            <div class="row d-flex justify-content-center"><!--FIRST ROW START-->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3><?=lang("General.change_staff_password")?></h3>
                        </div>
                        <form method="post" id="change_staff_password_form">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?=$staff['id']?>">
                                    <label for="email"><?=lang('Auth.fields.email')?></label>
                                    <input type="email" class="form-control" placeholder="<?=lang('Auth.fields.email')?>" value="<?=$staff['email']?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="password"><?=lang('Auth.fields.password')?></label>
                                    <input type="password" name="password" class="form-control" maxlength="15" placeholder="<?=lang('Auth.fields.password')?>" value="" required>
                                    <sub class="form-text text-danger error_field" id="password_error"></sub>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password"><?=lang('Auth.fields.confirm_password')?></label>
                                    <input type="password" name="confirm_password" class="form-control" maxlength="15" placeholder="<?=lang('Auth.fields.confirm_password')?>" value="" required>
                                    <sub class="form-text text-danger error_field" id="confirm_password_error"></sub>
                                </div>
                                <span class="text-success error_field" id="success"></span>
                                <span class="text-danger error_field" id="error"></span>          
                                <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('change_staff_password_form')"><?=lang("General.change_staff_password")?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--FIRST ROW END-->
        </div><!--FIRST CONTAINER END-->
    </div>

<?=view("plugins/js/form")?>