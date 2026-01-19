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
                                <li class="nav-item"><a class="nav-link active" href="#seoHomepageSettings" data-toggle="tab"><?=lang("Site.seo_homepage_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#seoBranchLocatorPageSettings" data-toggle="tab"><?=lang("Site.seo_branch_locator_page_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#seoCartPageSettings" data-toggle="tab"><?=lang("Site.seo_cart_page_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#seoContactPageSettings" data-toggle="tab"><?=lang("Site.seo_contact_page_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#seoPlanPageSettings" data-toggle="tab"><?=lang("Site.seo_plan_page_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#seoProductPageSettings" data-toggle="tab"><?=lang("Site.seo_product_page_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#seoLoginPageSettings" data-toggle="tab"><?=lang("Site.seo_login_page_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#seoRegisterPageSettings" data-toggle="tab"><?=lang("Site.seo_register_page_settings")?></a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="seoHomepageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoHomepageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_homepage_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_homepage_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_homepage_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_homepage_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_homepage_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_homepage_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_homepage_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_homepage_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_homepage_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_homepage_description" id="seo_homepage_description" class="form-control"><?=$settings["seo_homepage_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_homepage_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoHomepageSettingsForm')"><?=lang('Site.save')?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="seoProductPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoProductPageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_product_page_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_product_page_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_product_page_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_product_page_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_product_page_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_product_page_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_product_page_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_product_page_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_product_page_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_product_page_description" id="seo_product_page_description" class="form-control"><?=$settings["seo_product_page_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_product_page_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoProductPageSettingsForm')"><?=lang('Site.save')?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="seoPlanPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoPlanPageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_plan_page_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_plan_page_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_plan_page_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_plan_page_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_plan_page_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_plan_page_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_plan_page_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_plan_page_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_plan_page_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_plan_page_description" id="seo_plan_page_description" class="form-control"><?=$settings["seo_plan_page_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_plan_page_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoPlanPageSettingsForm')"><?=lang('Site.save')?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="seoContactPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoContactPageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_contact_page_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_contact_page_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_contact_page_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_contact_page_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_contact_page_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_contact_page_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_contact_page_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_contact_page_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_contact_page_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_contact_page_description" id="seo_contact_page_description" class="form-control"><?=$settings["seo_contact_page_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_contact_page_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoContactPageSettingsForm')"><?=lang('Site.save')?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="seoCartPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoCartPageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_cart_page_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_cart_page_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_cart_page_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_cart_page_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_cart_page_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_cart_page_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_cart_page_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_cart_page_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_cart_page_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_cart_page_description" id="seo_cart_page_description" class="form-control"><?=$settings["seo_cart_page_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_cart_page_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoCartPageSettingsForm')"><?=lang('Site.save')?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="seoBranchLocatorPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoBranchLocatorPageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_branch_locator_page_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_branch_locator_page_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_branch_locator_page_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_branch_locator_page_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_branch_locator_page_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_branch_locator_page_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_branch_locator_page_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_branch_locator_page_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_branch_locator_page_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_branch_locator_page_description" id="seo_branch_locator_page_description" class="form-control"><?=$settings["seo_branch_locator_page_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_branch_locator_page_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoBranchLocatorPageSettingsForm')"><?=lang('Site.save')?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="seoLoginPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoLoginPageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_login_page_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_login_page_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_login_page_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_login_page_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_login_page_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_login_page_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_login_page_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_login_page_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_login_page_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_login_page_description" id="seo_login_page_description" class="form-control"><?=$settings["seo_login_page_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_login_page_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoLoginPageSettingsForm')"><?=lang('Site.save')?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="seoRegisterPageSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="seoRegisterPageSettingsForm">                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_register_page_title"><?=lang("Site.title")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_register_page_title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$settings['seo_register_page_title']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_register_page_title_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_register_page_keywords"><?=lang("Site.keywords")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input class="form-control" name="seo_register_page_keywords" type="text" maxlength="255" placeholder="<?=lang("Site.keywords")?>" value="<?=$settings['seo_register_page_keywords']?>" required>
                                                    <sub class="form-text error_field text-danger" id="seo_register_page_keywords_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="seo_register_page_description"><?=lang("Site.description")?></label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <textarea name="seo_register_page_description" id="seo_register_page_description" class="form-control"><?=$settings["seo_register_page_description"]?></textarea>
                                                    <sub class="form-text error_field text-danger" id="seo_register_page_description_error"></sub>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('Site.close')?></button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('seoRegisterPageSettingsForm')"><?=lang('Site.save')?></button>
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