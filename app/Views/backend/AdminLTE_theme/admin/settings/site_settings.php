    <?=view('includes/css/bootstrap-fileinput')?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=$title?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form enctype="multipart/form-data" method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="update_site_settings">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="site_name"><?=lang("Site.site_name")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <input class="form-control" name="site_name" type="text" maxlength="255" placeholder="<?=lang("Site.site_name")?>" value="<?=$settings['site_name']?>" required>
                                            <sub class="form-text error_field text-danger" id="site_name_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="site_title"><?=lang("Site.site_title")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <input class="form-control" name="site_title" type="text" maxlength="255" placeholder="<?=lang("Site.site_title")?>" value="<?=$settings['site_title']?>" required>
                                            <sub class="form-text error_field text-danger" id="site_title_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="support_email"><?=lang("Site.support_email")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <input class="form-control" name="support_email" type="text" maxlength="255" placeholder="<?=lang("Site.support_email")?>" value="<?=$settings['support_email']?>" required>
                                            <sub class="text-danger">Contact Us form will be submitted to this Email</sub>
                                            <sub class="form-text error_field text-danger" id="support_email_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="currency"><?=lang("Site.currency")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <input class="form-control" name="currency" type="text" maxlength="255" placeholder="<?=lang("Site.currency")?>" value="<?=$settings['currency']?>" required>
                                            <sub class="form-text error_field text-danger" id="currency_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="tax_type"><?=lang("Site.tax")?></label>
                                        </div>
                                        <div class="col-md-5">
                                            <sub for="tax_type"><?=lang("Site.type")?></sub>
                                            <select class="form-control" name="tax_type">
                                                <option value=""></option>
                                                <option value="fixed" <?=$settings['tax_type'] == 'fixed' ? 'selected' : ''?>><?=lang("Site.fixed")?></option>
                                                <option value="percentage" <?=$settings['tax_type'] == 'percentage'? 'selected' : ''?>><?=lang("Site.percentage")?></option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="tax_type_error"></sub>
                                        </div>
                                        <div class="col-md-5">
                                            <sub for="tax_amount"><?=lang("Site.amount")?></sub>
                                            <input class="form-control" name="tax_amount" type="number" maxlength="255" placeholder="<?=lang("Site.amount")?>" value="<?=$settings['tax_amount']?>">
                                            <sub class="form-text error_field text-danger" id="tax_amount_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="timezone"><?=lang("Site.timezone")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <?php
                                                helper('date');
                                                echo timezone_select('form-control', $settings["timezone"]);
                                            ?>
                                            <sub class="form-text error_field text-danger" id="timezone_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="datetime_format"><?=lang("Site.datetime_format")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <input class="form-control" name="datetime_format" type="text" maxlength="255" placeholder="<?=lang("Site.datetime_format")?>" value="<?=$settings['datetime_format']?>">
                                            <sub class="form-text error_field text-danger" id="datetime_format_error"></sub>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="date_format"><?=lang("Site.date_format")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <select name="date_format" id="date_format" class="form-control" required>
                                                <option value=""></option>
                                                <option value="Y/m/d" <?=$settings['date_format'] == 'Y/m/d' ? 'selected' : ''?>><?=date('Y/m/d')?></option>
                                                <option value="d/m/Y" <?=$settings['date_format'] == 'd/m/Y' ? 'selected' : ''?>><?=date('d/m/Y')?></option>
                                                <option value="d M, Y" <?=$settings['date_format'] == 'd M, Y' ? 'selected' : ''?>><?=date('d M, Y')?></option>
                                                <option value="d F, Y" <?=$settings['date_format'] == 'd F, Y' ? 'selected' : ''?>><?=date('d F, Y')?></option>
                                                <option value="l, d F, Y" <?=$settings['date_format'] == 'l, d F, Y' ? 'selected' : ''?>><?=date('l, d F, Y')?></option>
                                                <option value="F d, Y" <?=$settings['date_format'] == 'F d, Y' ? 'selected' : ''?>><?=date('F d, Y')?></option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="date_format_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="time_format"><?=lang("Site.time_format")?></label>
                                        </div>
                                        <div class="col-12 col-md-10"> 
                                            <select name="time_format" id="time_format" class="form-control" required>
                                                <option value=""></option>
                                                <option value="H:i" <?=$settings['time_format'] == 'H:i' ? 'selected' : ''?>><?=lang("Site.24_hours")?></option>
                                                <option value="h:i a" <?=$settings['time_format'] == 'h:i a' ? 'selected' : ''?>><?=lang("Site.12_hours")?></option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="time_format_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            <label for="logo"><?=lang("Site.logo")?></label>
                                        </div>
                                        <div class="col-12 col-md-10">
                                            <input type="file" name="logo" id="logo" class="file" data-theme="fas" data-language="<?=siteLanguage()?>" data-show-close="false" data-show-upload="false" data-allowed-file-extensions='["png", "jpg", "jpeg"]' data-file-action-settings='{"indicatorNew":""}'>
                                            <sub class="form-text error_field text-danger" id="logo_error"></sub>
                                        </div>
                                    </div>
                                </div>


                                <span class="text-success error_field" id="success"></span>
                                <span class="text-danger error_field" id="error"></span>

                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('update_site_settings')"><?=lang("Site.save")?></button>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?=view('includes/js/bootstrap-fileinput')?>
    <script>    
        $("#logo").fileinput({
            initialPreview: [
                "<img src='<?=logo()?>' class='file-preview-image' style='height:100%;'>",
            ]
        });
    </script>
    <?=view('includes/js/form')?>