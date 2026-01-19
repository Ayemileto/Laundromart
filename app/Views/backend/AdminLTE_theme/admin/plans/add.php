<div class="my-2">
    <form method="post" action="<?=base_url().route_to('admin_route_save_plan')?>" id="add_plan_form">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2"> 
                        <label for="name"><?=lang('Site.plan_name')?></label>
                    </div>
                    <div class="col-12 col-md-10"> 
                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="<?=lang('Site.plan_name')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="name_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2"> 
                        <label for="tagline"><?=lang('Site.tagline')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" name="tagline" class="form-control" maxlength="255" placeholder="<?=lang('Site.tagline')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="tagline_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="monthly_price"><?=lang('Site.monthly_price')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="number" name="monthly_price" class="form-control" placeholder="<?=lang('Site.monthly_price')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="monthly_price_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="quarterly_price"><?=lang('Site.quarterly_price')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="number" name="quarterly_price" class="form-control" placeholder="<?=lang('Site.quarterly_price')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="quarterly_price_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="semi_annually_price"><?=lang('Site.semi_annually_price')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="number" name="semi_annually_price" class="form-control" placeholder="<?=lang('Site.semi_annually_price')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="semi_annually_price_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="yearly_price"><?=lang('Site.yearly_price')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="number" name="yearly_price" class="form-control" placeholder="<?=lang('Site.yearly_price')?>" value="" required>
                        <sub class="form-text text-danger error_field" id="yearly_price_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="orders_per_month"><?=lang('Site.orders_per_month')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="number" name="orders_per_month" class="form-control" placeholder="<?=lang('Site.orders_per_month')?>" value="" required>
                        <sub class="form-text text-danger"><?=lang('Site.orders_per_month_info')?></sub>
                        <sub class="form-text text-danger error_field" id="orders_per_month_error"></sub>
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
                            <option value="active"><?=lang('Site.active')?></option>
                            <option value="inactive"><?=lang('Site.inactive')?></option>
                        </select>
                        <sub class="form-text text-danger error_field" id="status_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="features"><?=lang('Site.features')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <span class='btn btn-xs btn-primary float-right my-1' onclick='addExtraFeature()'><?=lang('Site.add_another_feature')?></span>
                        <input type="text" name="features[]" class="form-control" maxlength="255" placeholder="<?=lang('Site.feature')?>" value="" required>
                        <div id="extra_feature"></div>
                        <sub class="form-text text-danger error_field" id="features_error"></sub>
                    </div>
                </div>
            </div>
            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('add_plan_form')"><?=lang("Site.add_plan")?></button>
        </div>
    </form>
</div>

<!-- /.content-wrapper -->

<?=view(adminTheme().'/admin/plans/form_js')?>
<?=view('includes/js/form')?>