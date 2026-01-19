<div class="login-box">
    <div class="login-logo">
        <a href="<?=fullUrl(route_to("home"))?>"><?=siteName()?></a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?=lang('Auth.resend_email_verification_link')?></p>

            <form id="resend_form" action="" method="post">
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
                        <button type="submit" class="btn btn-primary btn-block" id="form-submit" onclick="submitForm('resend_form')"><?=lang("Auth.send_link")?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.login-box -->