<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_save_product_services'))?>" id="add_product_service">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="name"><?=lang("Site.service_name")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="name" type="text" maxlength="255" placeholder="<?=lang("Site.service_name")?>" value="" required>
                    <sub class="form-text error_field text-danger" id="name_error"></sub>
                </div>
            </div>
        </div>

        <span class="text-success error_field" id="success"></span>
        <span class="text-danger error_field" id="error"></span>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('add_product_service')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view('includes/js/form')?>