<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_update_pickup'))?>" id="edit_shipping_form">
        <div class="card-body">
            <input type="hidden" name="shipping_id" class="form-control" value="<?=$shipping["id"]?>" required>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pickup_date"><?=lang("Site.pickup_date")?></label>
                    <input class="form-control" type="date" id="pickup_date" name="pickup_date" placeholder="<?=lang("Site.pickup_date")?>" value="<?=$shipping['pickup_date']?>">
                    <small class="text-danger error_field" id="pickup_date_error"></small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pickup_time"><?=lang("Site.pickup_time")?></label>
                    <input class="form-control" type="time" id="pickup_time" name="pickup_time" placeholder="<?=lang("Site.pickup_time")?>" value="<?=$shipping['pickup_time']?>">
                    <small class="text-danger error_field" id="pickup_time_error"></small>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2">
                        <label for="pickup_message"><?=lang('Site.pickup_message')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" name="pickup_message" class="form-control" maxlength="255" placeholder="<?=lang('Site.pickup_message')?>" value="<?=$shipping["pickup_message"]?>">
                        <sub class="form-text text-danger error_field" id="pickup_message_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2">
                        <label for="status"><?=lang('Site.status')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <select name="pickup_status" class="form-control" required>
                            <option value=""></option>
                            <option value="pending" <?=($shipping["pickup_status"] == "pending") ? "selected" : ""?>><?=lang('Site.pending')?></option>
                            <option value="failed" <?=($shipping["pickup_status"] == "failed") ? "selected" : ""?>><?=lang('Site.failed')?></option>
                            <option value="completed" <?=($shipping["pickup_status"] == "completed") ? "selected" : ""?>><?=lang('Site.completed')?></option>
                        </select>
                        <sub class="form-text text-danger error_field" id="status_error"></sub>
                    </div>
                </div>
            </div>
            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('edit_shipping_form')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view("includes/js/form")?>