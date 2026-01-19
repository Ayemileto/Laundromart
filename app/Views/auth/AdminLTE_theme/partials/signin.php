<div class="login-box">
    <div class="login-logo">
        <a href="<?=base_url().route_to("home")?>"><?=siteName()?></a>
    </div> 

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?=lang("Auth.login")?></p>

            <form id="signin_form" action="<?=fullUrl(route_to('do_login'))?>" method="post">
                <div class="input-group mb-3">
                    <input type="hidden" name="next" value="<?=$next?>">
                    <input type="email" class="form-control" placeholder="<?=lang("Auth.email")?>" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="email_error"></sub>
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
                <div class="row">
                    <span class="col-12 text-danger error_field" id="error_error"></span>
                    <span class="col-12 text-success error_field" id="success"></span>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" value="yea">
                            <label for="remember">
                            <?=lang("Auth.remember_me")?>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button class="btn btn-primary btn-block" onclick="submitForm('signin_form')" id="form-submit"><?=lang("Auth.login")?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-1">
                <a href="<?=base_url().route_to("forgot_password")?>"><?=lang("Auth.forgot_password")?></a>
            </p>
            <p class="mb-0">
                <?=lang("Auth.dont_have_an_account")?> <a href="<?=base_url().route_to("register");?>"><?=lang("Auth.register")?></a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.login-box -->