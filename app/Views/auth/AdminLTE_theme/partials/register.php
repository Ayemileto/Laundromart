<div class="register-box">
    <div class="register-logo">
        <a href="<?=base_url().route_to("home")?>"><?=siteName()?></a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg"><?=lang("Auth.register")?></p>

            <form id="register_form" action="<?=fullUrl(route_to('do_register'))?>" method="post">
                <div class="input-group mb-3">
                   <input type="text" class="form-control" placeholder="<?=lang("Auth.firstname")?>" name="firstname" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="firstname_error"></sub>
                </div>
                <div class="input-group mb-3">
                   <input type="text" class="form-control" placeholder="<?=lang("Auth.lastname")?>" name="lastname" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="lastname_error"></sub>
                </div>
                <div class="input-group mb-3">
                   <input type="text" class="form-control" placeholder="<?=lang("Auth.username")?>" name="username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="username_error"></sub>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="<?=lang("Auth.email")?>" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="email_error"></sub>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="<?=lang("Auth.phone")?>" name="phone" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="phone_error"></sub>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="<?=lang("Auth.password")?>" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="password_error"></sub>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirm_password" placeholder="<?=lang("Auth.confirm_password")?>" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="confirm_password_error"></sub>
                </div>
                <div class="row">
                    <span class="col-12 text-danger error_field" id="error_error"></span>
                    <span class="col-12 text-success error_field" id="success"></span>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label for="agreeTerms">
                            <!-- <?=lang("Auth.i_agree_to_the_terms")?> -->
                                <?=getSetting('register_page_terms_text')?>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="form-submit" onclick="submitForm('register_form')"><?=lang("Auth.fields.register")?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form> 
            <?=lang("Auth.already_have_an_account")?>
            <a href="<?=base_url().route_to("login")?>" class="text-center"><?=lang("Auth.login")?></a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->