<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_update_delivery'))?>" id="edit_shipping_form">
        <div class="card-body">
            <input type="hidden" name="shipping_id" class="form-control" value="<?=$shipping["id"]?>" required>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="delivery_date"><?=lang("Site.delivery_date")?></label>
                    <input class="form-control" type="date" id="delivery_date" name="delivery_date" placeholder="<?=lang("Site.delivery_date")?>" value="<?=$shipping['delivery_date']?>">
                    <small class="text-danger error_field" id="delivery_date_error"></small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="delivery_time"><?=lang("Site.delivery_time")?></label>
                    <input class="form-control" type="time" id="delivery_time" name="delivery_time" placeholder="<?=lang("Site.delivery_time")?>" value="<?=$shipping['delivery_time']?>">
                    <small class="text-danger error_field" id="delivery_time_error"></small>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2">
                        <label for="delivery_message"><?=lang('Site.delivery_message')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" name="delivery_message" class="form-control" maxlength="255" placeholder="<?=lang('Site.delivery_message')?>" value="<?=$shipping["delivery_message"]?>">
                        <sub class="form-text text-danger error_field" id="delivery_message_error"></sub>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                   <div class="col-12 col-md-2">
                        <label for="status"><?=lang('Site.status')?></label>
                    </div>
                    <div class="col-12 col-md-10">
                        <select name="delivery_status" class="form-control" required>
                            <option value=""></option>
                            <option value="pending" <?=($shipping["delivery_status"] == "pending") ? "selected" : ""?>><?=lang('Site.pending')?></option>
                            <option value="failed" <?=($shipping["delivery_status"] == "failed") ? "selected" : ""?>><?=lang('Site.failed')?></option>
                            <option value="completed" <?=($shipping["delivery_status"] == "completed") ? "selected" : ""?>><?=lang('Site.completed')?></option>
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