<?=view('includes/css/summernote')?>

<div class="my-2">
    <form method="post" action="<?=base_url().route_to('admin_route_update_branch', $branch['id'])?>" id="edit_branch_form">
        <input type="hidden" name="branch_id" value="<?=$branch['id']?>">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.zipcode')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <input type="text" name="zipcode" class="form-control" maxlength="255" placeholder="<?=lang('Site.zipcode')?>" value="<?=$branch['zipcode']?>" required>
                        <sub class="form-text text-danger error_field" id="zipcode_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.office_address')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <textarea name="office_address" id="office_address" class="form-control" placeholder="<?=lang('Site.office_address')?>"><?=$branch['office_address']?></textarea>
                        <sub class="form-text text-danger error_field" id="office_address_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2"> 
                        <label for="office_phone"><?=lang('Site.office_phone')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" name="office_phone" class="form-control" maxlength="255" placeholder="<?=lang('Site.office_phone')?>" value="<?=$branch['office_phone']?>">
                        <sub class="form-text text-danger error_field" id="office_phone_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2"> 
                        <label for="google_map_location"><?=lang('Site.google_map_location')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <span class="text-danger">Search / Click the office location on Google Map, Click "share", Click "Embed a Map", Click "Copy HTML". Paste the copied item below.</span>
                        <textarea name="google_map_location" id="google_map_location" class="form-control" placeholder="<?=lang('Site.google_map_location')?>"><?=$branch['google_map_location']?></textarea>
                        <sub class="form-text text-danger error_field" id="google_map_location_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="status"><?=lang('Site.status')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <select name="status" class="form-control" required>
                            <option value=""></option>
                            <option value="active" <?=$branch['status'] == 'active' ? 'selected' : ''?>><?=lang('Site.active')?></option>
                            <option value="inactive" <?=$branch['status'] != 'active' ? 'selected' : ''?>><?=lang('Site.inactive')?></option>
                        </select>
                        <sub class="form-text text-danger error_field" id="status_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="show_on_homepage"><?=lang('Site.show_on_homepage')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <select name="show_on_homepage" class="form-control" required>
                            <option value="yes" <?=$branch['show_on_homepage'] == 'yes' ? 'selected' : ''?>><?=lang('Site.yes')?></option>
                            <option value="no"  <?=$branch['show_on_homepage'] != 'yes' ? 'selected' : ''?>><?=lang('Site.no')?></option>
                        </select>
                        <sub class="form-text text-danger error_field" id="show_on_homepage_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="show_on_contact_page"><?=lang('Site.show_on_contact_page')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <select name="show_on_contact_page" class="form-control" required>
                            <option value="yes" <?=$branch['show_on_contact_page'] == 'yes' ? 'selected' : ''?>><?=lang('Site.yes')?></option>
                            <option value="no"  <?=$branch['show_on_contact_page'] != 'yes' ? 'selected' : ''?>><?=lang('Site.no')?></option>
                        </select>
                        <sub class="form-text text-danger error_field" id="show_on_contact_page_error"></sub>
                    </div>
                </div>
            </div>
            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('edit_branch_form')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<!-- /.content-wrapper -->

<?=view("includes/js/form")?>
<?=view('includes/js/summernote')?>
