    <?=view('includes/css/summernote')?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <b><?=lang("Site.edit_pages_help", [frontTheme()])?>/pages</b><br>
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#GeneralPageSettings" data-toggle="tab"><?=lang("Site.page_general_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#PageSnippetsSettings" data-toggle="tab"><?=lang("Site.page_snippets_settings")?></a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="GeneralPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="GeneralPageSettingsForm">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_branch_locator_page"><?=lang("Site.branch_locator_page")?></label>
                                                </div>
                                                <div class="col-12 col-md-9"> 
                                                    <input type="radio" id="enable_branch_locator_page" name="enable_branch_locator_page" value="yes" <?=$settings["enable_branch_locator_page"] == "yes" ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                    <input type="radio" class="ml-3" id="enable_branch_locator_page" name="enable_branch_locator_page" value="no" <?=$settings["enable_branch_locator_page"] == "yes" ? '' : 'checked'?>><b> <?=lang("Site.disable")?></b>
                                                    <sub class="error_field text-danger" id="enable_branch_locator_page_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_contact_us_page"><?=lang("Site.contact_us_page")?></label>
                                                </div>
                                                <div class="col-12 col-md-9"> 
                                                    <input type="radio" id="enable_contact_us_page" name="enable_contact_us_page" value="yes" <?=$settings["enable_contact_us_page"] == "yes" ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                    <input type="radio" class="ml-3" id="enable_contact_us_page" name="enable_contact_us_page" value="no" <?=$settings["enable_contact_us_page"] == "yes" ? '' : 'checked'?>><b> <?=lang("Site.disable")?></b>
                                                    <sub class="error_field text-danger" id="enable_contact_us_page_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_products_page"><?=lang("Site.products_page")?></label>
                                                </div>
                                                <div class="col-12 col-md-9"> 
                                                    <input type="radio" id="enable_products_page" name="enable_products_page" value="yes" <?=$settings["enable_products_page"] == "yes" ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                    <input type="radio" class="ml-3" id="enable_products_page" name="enable_products_page" value="no" <?=$settings["enable_products_page"] == "yes" ? '' : 'checked'?>><b> <?=lang("Site.disable")?></b>
                                                    <sub class="error_field text-danger" id="enable_products_page_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="enable_subscription_plans_page"><?=lang("Site.plans_page")?></label>
                                                </div>
                                                <div class="col-12 col-md-9"> 
                                                    <input type="radio" id="enable_subscription_plans_page" name="enable_subscription_plans_page" value="yes" <?=$settings["enable_subscription_plans_page"] == "yes" ? 'checked' : ''?>><b> <?=lang("Site.enable")?></b>
                                                    <input type="radio" class="ml-3" id="enable_subscription_plans_page" name="enable_subscription_plans_page" value="no" <?=$settings["enable_subscription_plans_page"] == "yes" ? '' : 'checked'?>><b> <?=lang("Site.disable")?></b>
                                                    <sub class="error_field text-danger" id="enable_subscription_plans_page_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field" id="success"></span>
                                        <span class="text-danger error_field" id="error"></span>

                                        <div class="">
                                            <button type="submit" class="btn btn-primary mt-2 float-right" id="form-submit" onclick="submitForm('GeneralPageSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="PageSnippetsSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="PageSnippetsSettingsForm">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="footer_text"><?=lang("Site.footer_text")?></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <textarea name="footer_text" class="form-control summernote-textarea" maxlength="255" placeholder="<?=lang("Site.footer_text")?>">
                                                            <?=$settings['footer_text']?>
                                                        </textarea>
                                                        <sub class="error_field text-danger" id="footer_text_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-3"> 
                                                    <label for="register_page_terms_text"><?=lang("Site.register_page_terms_text")?></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="form-group">
                                                        <textarea name="register_page_terms_text" class="form-control summernote-textarea" maxlength="255" placeholder="<?=lang("Site.register_page_terms_text")?>">
                                                            <?=$settings['register_page_terms_text']?>
                                                        </textarea>
                                                        <sub class="error_field text-danger" id="register_page_terms_text_error"></sub>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-success error_field" id="success"></span>
                                        <span class="text-danger error_field" id="error"></span>

                                        <div class="">
                                            <button type="submit" class="btn btn-primary mt-2 float-right" id="form-submit" onclick="submitForm('PageSnippetsSettingsForm')"><?=lang("Site.save")?></button>
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


    <?=view('includes/js/form')?>
    <?=view('includes/js/summernote')?>