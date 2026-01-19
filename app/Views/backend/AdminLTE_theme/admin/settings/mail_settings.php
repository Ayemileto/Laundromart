<style>
    .hide {
        display: none;
    }
</style>
<?=view('includes/css/summernote')?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#mailGeneralSettings" data-toggle="tab"><?=lang("Site.mail_general_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#mailTemplateSettings" data-toggle="tab"><?=lang("Site.mail_template_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#mailContentSettings" data-toggle="tab"><?=lang("Site.mail_content_settings")?></a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="mailGeneralSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="mailGeneralSettingsForm">
                                        <input type="hidden" name="section" value="mail">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="sender_email"><?=lang("Site.mail_sender_email")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="sender_email" name="sender_email" placeholder="<?=lang("Site.mail_sender_email")?>" value="<?=$settings["sender_email"]?>" required>
                                                    <sub class="error_field text-danger" id="sender_email_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="sender_name"><?=lang("Site.mail_sender_name")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="<?=lang("Site.mail_sender_name")?>" value="<?=$settings["sender_name"]?>" required>
                                                    <sub class="error_field text-danger" id="sender_name_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="mail_protocol"><?=lang("Site.mail_protocol")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select class="form-control" id="mail_protocol" name="mail_protocol" onChange="mailProtocolConfig()" required>
                                                        <option value=""></option>
                                                        <option value="smtp" <?=$settings["mail_protocol"] == 'smtp' ? 'selected' : ''?>>SMTP</option>
                                                        <option value="sendmail" <?=$settings["mail_protocol"] == 'sendmail' ? 'selected' : ''?>>SendMail</option>
                                                        <option value="mail" <?=$settings["mail_protocol"] == 'mail' ? 'selected' : ''?>>Mail</option>
                                                    </select>
                                                    <sub class="error_field text-danger" id="mail_protocol_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="mail_charset"><?=lang("Site.mail_charset")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="mail_charset" name="mail_charset" placeholder="Charset" value="<?=$settings["mail_charset"]?>" required>
                                                    <sub class="error_field text-danger" id="mail_charset_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mail_protocol_config <?=$settings["mail_protocol"] != 'smtp' ? 'hide' : ''?>" id="mail_smtp_config">
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="smtp_host"><?=lang("Site.smtp_host")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10"> 
                                                        <input type="text" class="form-control" id="smtp_host" name="smtp_host" placeholder="<?=lang("Site.smtp_host")?>" value="<?=$settings["smtp_host"]?>" required>
                                                        <sub class="error_field text-danger" id="smtp_host_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="smtp_user"><?=lang("Site.smtp_user")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10"> 
                                                        <input type="text" class="form-control" id="smtp_user" name="smtp_user" placeholder="<?=lang("Site.smtp_user")?>" value="<?=$settings["smtp_user"]?>" required>
                                                        <sub class="error_field text-danger" id="smtp_user_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="smtp_pass"><?=lang("Site.smtp_pass")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10"> 
                                                        <input type="text" class="form-control" id="smtp_pass" name="smtp_pass" placeholder="<?=lang("Site.smtp_pass")?>" value="<?=$settings["smtp_pass"]?>" required>
                                                        <sub class="error_field text-danger" id="smtp_pass_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="smtp_port"><?=lang("Site.smtp_port")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10"> 
                                                        <input type="text" class="form-control" id="smtp_port" name="smtp_port" placeholder="<?=lang("Site.smtp_port")?>" value="<?=$settings["smtp_port"]?>" required>
                                                        <sub class="error_field text-danger" id="smtp_port_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="smtp_timeout"><?=lang("Site.smtp_timeout")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10"> 
                                                        <input type="text" class="form-control" id="smtp_timeout" name="smtp_timeout" placeholder="<?=lang("Site.smtp_timeout")?>" value="<?=$settings["smtp_timeout"]?>" required>
                                                        <sub class="error_field text-danger" id="smtp_timeout_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="smtp_encryption"><?=lang("Site.smtp_encryption")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10"> 
                                                        <select class="form-control" name="smtp_encryption" required>
                                                            <option value=""></option>
                                                            <option value="ssl" <?=$settings["smtp_encryption"] == 'ssl' ? 'selected' : ''?>>SSL</option>
                                                            <option value="tls" <?=$settings["smtp_encryption"] == 'tls' ? 'selected' : ''?>>TLS</option>
                                                        </select>
                                                        <sub class="error_field text-danger" id="smtp_encryption_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="smtp_keep_alive"><?=lang("Site.smtp_keep_alive")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <select class="form-control" name="smtp_keep_alive" required>
                                                            <option value=""></option>
                                                            <option value="1" <?=$settings["smtp_keep_alive"] == true ? 'selected' : ''?>>True</option>
                                                            <option value="0" <?=$settings["smtp_keep_alive"] == false ? 'selected' : ''?>>False</option>
                                                        </select>
                                                        <small>Keep Persistent Connection</small>
                                                        <sub class="error_field text-danger" id="smtp_keep_alive_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mail_protocol_config <?=$settings["mail_protocol"] != 'sendmail' ? 'hide' : ''?>" id="mail_sendmail_config">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-2"> 
                                                        <label for="sendmail_path"><?=lang("Site.sendmail_path")?></label>
                                                    </div>
                                                    <div class="col-12 col-md-10"> 
                                                        <input type="text" class="form-control" id="sendmail_path" name="sendmail_path" placeholder="<?=lang("Site.sendmail_path")?>" value="<?=$settings["sendmail_path"]?>" required>
                                                        <sub class="error_field text-danger" id="sendmail_path_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field" id="success"></span>
                                        <span class="text-danger error_field" id="error"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('mailGeneralSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="mailTemplateSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="mailTemplateSettingsForm">
                                        <input type="hidden" name="section" value="mail">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="mail_template"><?=lang("Site.mail_template")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select class="form-control" id="mail_template" name="mail_template" onChange="mailTemplateConfig()" required>
                                                        <option value=""></option>

                                                        <?php
                                                            $mail_themes_path = str_replace('\\', '/', APPPATH."Views/email/*_theme");

                                                            $mail_themes = glob($mail_themes_path, GLOB_BRACE);

                                                            foreach($mail_themes as $theme)
                                                            {
                                                                $pathInfo = pathinfo($theme);
                                                                $filename = $pathInfo['filename'];
                                                                $filename = str_replace('_theme', '', $filename);
                                                                
                                                                $display_name = ucwords(preg_replace('/[^A-Za-z0-9]/', ' ', $filename));
                                                        ?>
                                                                <option value="<?=$filename?>" <?=$settings["mail_template"] == $filename ? 'selected' : ''?>><?=$display_name?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                    <sub class="error_field text-danger" id="mail_template_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field" id="success"></span>
                                        <span class="text-danger error_field" id="error"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('mailTemplateSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="mailContentSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="mailContentSettingsForm">
                                        <input type="hidden" name="section" value="mail">
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="mail_footer"><?=lang("Site.mail_footer")?></label>
                                                </div>
                                                <div class="col-12 col-md-9"> 
                                                    <textarea name="mail_footer" id="mail_footer" class="form-control"><?=$settings["mail_footer"]?></textarea>
                                                    <sub class="error_field text-danger" id="mail_footer_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_welcome_mail"><?=lang("Site.mail_welcome_message")?></label>
                                                    <br><input type="checkbox" id="enable_welcome_mail" name="enable_welcome_mail" value="yes" <?=isEnabled('welcome_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="welcome_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="welcome_mail_subject" id="welcome_mail_subject" value="<?=$settings["welcome_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="welcome_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="welcome_mail_message" id="welcome_mail_message" class="form-control"><?=$settings["welcome_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="welcome_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_verify_account_mail"><?=lang("Site.mail_verify_account_message")?></label>
                                                    <br><input type="checkbox" id="enable_verify_account_mail" name="enable_verify_account_mail" value="yes" <?=isEnabled('verify_account_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="verify_account_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="verify_account_mail_subject" id="verify_account_mail_subject" value="<?=$settings["verify_account_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="verify_account_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="verify_account_mail_message" id="verify_account_mail_message" class="form-control"><?=$settings["verify_account_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="verify_account_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_reset_password_mail"><?=lang("Site.mail_reset_password_message")?></label>
                                                    <br><input type="checkbox" id="enable_reset_password_mail" name="enable_reset_password_mail" value="yes" <?=isEnabled('reset_password_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="reset_password_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="reset_password_mail_subject" id="reset_password_mail_subject" value="<?=$settings["reset_password_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reset_password_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="reset_password_mail_message" id="reset_password_mail_message" class="form-control"><?=$settings["reset_password_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="reset_password_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_order_confirmed_mail"><?=lang("Site.mail_order_confirmed_message")?></label>
                                                    <br><input type="checkbox" id="enable_order_confirmed_mail" name="enable_order_confirmed_mail" value="yes" <?=isEnabled('order_confirmed_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="order_confirmed_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="order_confirmed_mail_subject" id="order_confirmed_mail_subject" value="<?=$settings["order_confirmed_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="order_confirmed_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="order_confirmed_mail_message" id="order_confirmed_mail_message" class="form-control"><?=$settings["order_confirmed_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="order_confirmed_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_subscription_confirmed_mail"><?=lang("Site.mail_subscription_confirmed_message")?></label>
                                                    <br><input type="checkbox" id="enable_subscription_confirmed_mail" name="enable_subscription_confirmed_mail" value="yes" <?=isEnabled('subscription_confirmed_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="subscription_confirmed_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="subscription_confirmed_mail_subject" id="subscription_confirmed_mail_subject" value="<?=$settings["subscription_confirmed_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subscription_confirmed_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="subscription_confirmed_mail_message" id="subscription_confirmed_mail_message" class="form-control"><?=$settings["subscription_confirmed_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="subscription_confirmed_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_pickup_scheduled_mail"><?=lang("Site.mail_pickup_scheduled_message")?></label>
                                                    <br><input type="checkbox" id="enable_pickup_scheduled_mail" name="enable_pickup_scheduled_mail" value="yes" <?=isEnabled('pickup_scheduled_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="pickup_scheduled_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="pickup_scheduled_mail_subject" id="pickup_scheduled_mail_subject" value="<?=$settings["pickup_scheduled_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pickup_scheduled_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="pickup_scheduled_mail_message" id="pickup_scheduled_mail_message" class="form-control"><?=$settings["pickup_scheduled_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="pickup_scheduled_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_pickup_schedule_reminder_mail"><?=lang("Site.mail_pickup_schedule_reminder_message")?></label>
                                                    <br><input type="checkbox" id="enable_pickup_schedule_reminder_mail" name="enable_pickup_schedule_reminder_mail" value="yes" <?=isEnabled('pickup_schedule_reminder_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="pickup_schedule_reminder_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="pickup_schedule_reminder_mail_subject" id="pickup_schedule_reminder_mail_subject" value="<?=$settings["pickup_schedule_reminder_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pickup_schedule_reminder_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="pickup_schedule_reminder_mail_message" id="pickup_schedule_reminder_mail_message" class="form-control"><?=$settings["pickup_schedule_reminder_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="pickup_schedule_reminder_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_pickup_successful_mail"><?=lang("Site.mail_pickup_successful_message")?></label>
                                                    <br><input type="checkbox" id="enable_pickup_successful_mail" name="enable_pickup_successful_mail" value="yes" <?=isEnabled('pickup_successful_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="pickup_successful_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="pickup_successful_mail_subject" id="pickup_successful_mail_subject" value="<?=$settings["pickup_successful_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pickup_successful_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="pickup_successful_mail_message" id="pickup_successful_mail_message" class="form-control"><?=$settings["pickup_successful_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="pickup_successful_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_pickup_failed_mail"><?=lang("Site.mail_pickup_failed_message")?></label>
                                                    <br><input type="checkbox" id="enable_pickup_failed_mail" name="enable_pickup_failed_mail" value="yes" <?=isEnabled('pickup_failed_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="pickup_failed_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="pickup_failed_mail_subject" id="pickup_failed_mail_subject" value="<?=$settings["pickup_failed_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pickup_failed_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="pickup_failed_mail_message" id="pickup_failed_mail_message" class="form-control"><?=$settings["pickup_failed_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="pickup_failed_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_delivery_scheduled_mail"><?=lang("Site.mail_delivery_scheduled_message")?></label>
                                                    <br><input type="checkbox" id="enable_delivery_scheduled_mail" name="enable_delivery_scheduled_mail" value="yes" <?=isEnabled('delivery_scheduled_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="delivery_scheduled_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="delivery_scheduled_mail_subject" id="delivery_scheduled_mail_subject" value="<?=$settings["delivery_scheduled_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="delivery_scheduled_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="delivery_scheduled_mail_message" id="delivery_scheduled_mail_message" class="form-control"><?=$settings["delivery_scheduled_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="delivery_scheduled_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_delivery_schedule_reminder_mail"><?=lang("Site.mail_delivery_schedule_reminder_message")?></label>
                                                    <br><input type="checkbox" id="enable_delivery_schedule_reminder_mail" name="enable_delivery_schedule_reminder_mail" value="yes" <?=isEnabled('delivery_schedule_reminder_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="delivery_schedule_reminder_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="delivery_schedule_reminder_mail_subject" id="delivery_schedule_reminder_mail_subject" value="<?=$settings["delivery_schedule_reminder_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="delivery_schedule_reminder_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="delivery_schedule_reminder_mail_message" id="delivery_schedule_reminder_mail_message" class="form-control"><?=$settings["delivery_schedule_reminder_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="delivery_schedule_reminder_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_delivery_successful_mail"><?=lang("Site.mail_delivery_successful_message")?></label>
                                                    <br><input type="checkbox" id="enable_delivery_successful_mail" name="enable_delivery_successful_mail" value="yes" <?=isEnabled('delivery_successful_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="delivery_successful_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="delivery_successful_mail_subject" id="delivery_successful_mail_subject" value="<?=$settings["delivery_successful_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="delivery_successful_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="delivery_successful_mail_message" id="delivery_successful_mail_message" class="form-control"><?=$settings["delivery_successful_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="delivery_successful_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_delivery_failed_mail"><?=lang("Site.mail_delivery_failed_message")?></label>
                                                    <br><input type="checkbox" id="enable_delivery_failed_mail" name="enable_delivery_failed_mail" value="yes" <?=isEnabled('delivery_failed_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="delivery_failed_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="delivery_failed_mail_subject" id="delivery_failed_mail_subject" value="<?=$settings["delivery_failed_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="delivery_failed_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="delivery_failed_mail_message" id="delivery_failed_mail_message" class="form-control"><?=$settings["delivery_failed_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="delivery_failed_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_invoice_created_mail"><?=lang("Site.mail_invoice_created_message")?></label>
                                                    <br><input type="checkbox" id="enable_invoice_created_mail" name="enable_invoice_created_mail" value="yes" <?=isEnabled('invoice_created_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="invoice_created_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="invoice_created_mail_subject" id="invoice_created_mail_subject" value="<?=$settings["invoice_created_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="invoice_created_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="invoice_created_mail_message" id="invoice_created_mail_message" class="form-control"><?=$settings["invoice_created_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="invoice_created_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_invoice_paid_mail"><?=lang("Site.mail_invoice_paid_message")?></label>
                                                    <br><input type="checkbox" id="enable_invoice_paid_mail" name="enable_invoice_paid_mail" value="yes" <?=isEnabled('invoice_paid_mail') ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <label for="invoice_paid_mail_subject"><?=lang("Site.subject")?></label>
                                                        <input type="text" class="form-control" name="invoice_paid_mail_subject" id="invoice_paid_mail_subject" value="<?=$settings["invoice_paid_mail_subject"]?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="invoice_paid_mail_message"><?=lang("Site.message")?></label>
                                                        <textarea name="invoice_paid_mail_message" id="invoice_paid_mail_message" class="form-control"><?=$settings["invoice_paid_mail_message"]?></textarea>
                                                        <sub class="error_field text-danger" id="invoice_paid_mail_message_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-success error_field" id="success"></span>
                                        <span class="text-danger error_field" id="error"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('mailContentSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function mailProtocolConfig()
    {
        $(".mail_protocol_config").addClass("hide");
        let mail_protocol = $("#mail_protocol").val();
        
        if(mail_protocol == "smtp")
        {
            $("#mail_smtp_config").removeClass("hide");
        }

        if(mail_protocol == "sendmail")
        {
            $("#mail_sendmail_config").removeClass("hide");
        }
    }
</script>

<script>
    // IF CHECKBOX IS UNCHECKED, NOTHING GETS SUBMITTED TO THE SERVER FOR THT FIELD.
    // SO, THIS ADDS AN HIDDEN INPUT FIELD TO TELL THE SERVER THAT PARTICULAR FIELD WAS UNSELECTED. 
    $("#mailContentSettingsForm input:checkbox").change(function()
    {
        let field_name = $(this).attr('name');
        let id = field_name+"_mailContentSettingsForm_no_input";

        if($(this).is(":checked"))
        {
            $("#"+id).remove();
        }
        else
        {
            input = '<input type="hidden" id="'+id+'" name="'+field_name+'" value="no">';
            $("#mailContentSettingsForm").append(input);
        }
    });
</script>

<?=view('includes/js/form')?>
<?=view('includes/js/summernote')?>