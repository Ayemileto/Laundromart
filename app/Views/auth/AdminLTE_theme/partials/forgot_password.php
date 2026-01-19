<div class="login-box">
    <div class="login-logo">
        <a href="<?=base_url().route_to("home")?>"><?=siteName()?></a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?=lang("Auth.forgot_password")?></p>

            <form id="forgot_password_form" action="" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="<?=lang("Auth.email")?>" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <sub class="error_field text-danger" id="email_error"></sub>
                </div>
                <div class="row">
                    <span class="col-12 text-danger error_field" id="error_error"></span>
                    <span class="col-12 text-success error_field" id="success"></span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="form-submit" onclick="submitForm('forgot_password_form')"><?=lang("Auth.fields.send_link")?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-1">
                <a href="<?=base_url().route_to("login")?>"><?=lang("Auth.fields.login")?></a>
                <a href="<?=base_url().route_to("register");?>" class="float-right"><?=lang("Auth.fields.register")?></a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.login-box -->