<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_update_plan', $plan["id"]))?>" id="edit_plan_form">
        <div class="card-body">
            <input type="hidden" name="plan_id" class="form-control" value="<?=$plan["id"]?>" required>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2">
                        <label for="name"><?=lang("Site.plan")." ".lang("Site.name")?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="<?=lang("Site.plan")." ".lang("Site.name")?>" value="<?=$plan["name"]?>" required>
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
                        <input type="text" name="tagline" class="form-control" maxlength="255" placeholder="<?=lang('Site.tagline')?>" value="<?=$plan["tagline"]?>" required>
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
                        <input type="number" name="monthly_price" class="form-control" placeholder="<?=lang('Site.monthly_price')?>" value="<?=$plan["monthly_price"]?>" required>
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
                        <input type="number" name="quarterly_price" class="form-control" placeholder="<?=lang('Site.quarterly_price')?>" value="<?=$plan["quarterly_price"]?>">
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
                        <input type="number" name="semi_annually_price" class="form-control" placeholder="<?=lang('Site.semi_annually_price')?>" value="<?=$plan["semi_annually_price"]?>">
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
                        <input type="number" name="yearly_price" class="form-control" placeholder="<?=lang('Site.yearly_price')?>" value="<?=$plan["yearly_price"]?>">
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
                        <input type="number" name="orders_per_month" class="form-control" placeholder="<?=lang('Site.orders_per_month')?>" value="<?=$plan["orders_per_month"]?>" required>
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
                            <option value=""><?=lang("Site.status")?></option>
                            <option value="active" <?=($plan["status"] == "active") ? "selected" : ""?>><?=lang('Site.active')?></option>
                            <option value="inactive" <?=($plan["status"] == "inactive") ? "selected" : ""?>><?=lang('Site.inactive')?></option>
                        </select>
                        <sub class="form-text text-danger error_field" id="status_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
<?php
    $features = explode(';;', $plan["features"]);
    $first_feature = $features[0] ?? '';
    array_shift($features);
?>
                <div class="row">
                   <div class="col-12 col-md-2">
                        <label for="features"><?=lang('Site.features')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <span class='btn btn-xs btn-primary float-right my-1' onclick='addExtraFeature()'><?=lang('Site.add_another_feature')?></span>
                        <input type="text" name="features[]" class="form-control" maxlength="255" placeholder="<?=lang('Site.feature')?>" value="<?=$first_feature?>" required>
                
                        <div id="extra_feature">
<?php
    $added_extra = 1;
    foreach($features as $feature):
        $extra_id = 'extra_'.$added_extra;
?>
                            <div class="input-group mt-1" id="<?=$extra_id?>">
                                <input type="text" name="features[]" class="form-control" placeholder="<?=lang('Site.feature')?>" value="<?=$feature?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="removeExtraFeature('<?=$extra_id?>')"><i class="fas fa-trash text-danger cusor"></i></span>
                                </div>
                            </div>
<?php
        $added_extra++;
    endforeach;
?>
                        </div>
                        <sub class="form-text text-danger error_field" id="features_error"></sub>
                    </div>
                </div>
            </div>
            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('edit_plan_form')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view("backend/AdminLTE_theme/admin/plans/form_js")?>
<?=view("includes/js/form")?>