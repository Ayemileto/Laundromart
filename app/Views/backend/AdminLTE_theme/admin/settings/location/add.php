<?=view('includes/css/summernote')?>

<div class="my-2">
    <form method="post" action="<?=base_url().route_to('admin_route_save_location')?>" id="add_location_form">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.name')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="<?=lang('Site.name')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="name_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.zipcode')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <input type="text" name="zipcode" class="form-control" maxlength="255" placeholder="<?=lang('Site.zipcode')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="zipcode_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.pickup_only_price')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <input class="form-control" name="pickup_only_price" type="number" step="0.01" placeholder="<?=lang("Site.pickup_only_price")?>" value="">
                        <sub class="form-text text-danger error_field" id="pickup_only_price_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.delivery_only_price')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <input class="form-control" name="delivery_only_price" type="number" step="0.01" placeholder="<?=lang("Site.delivery_only_price")?>" value="">
                        <sub class="form-text text-danger error_field" id="delivery_only_price_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.pickup_delivery_price')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <input class="form-control" name="pickup_delivery_price" type="number" step="0.01" placeholder="<?=lang("Site.pickup_delivery_price")?>" value="">
                        <sub class="form-text text-danger error_field" id="pickup_delivery_price_error"></sub>
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
                            <option value=""><?=lang("Site.status")?></option>
                            <option value="active"><?=lang('Site.active')?></option>
                            <option value="inactive"><?=lang('Site.inactive')?></option>
                        </select>
                        <sub class="form-text text-danger error_field" id="status_error"></sub>
                    </div>
                </div>
            </div>
            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('add_location_form')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<!-- /.content-wrapper -->

<?=view("includes/js/form")?>
<?=view('includes/js/summernote')?>
