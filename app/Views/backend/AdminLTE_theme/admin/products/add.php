<div class="my-2">
    <form enctype="multipart/form-data" method="post" action="<?=fullUrl(route_to('admin_route_save_product'))?>" id="add_product">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="name"><?=lang("Site.product_name")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="name" type="text" maxlength="255" placeholder="<?=lang("Site.product_name")?>" value="" required>
                    <sub class="form-text error_field text-danger" id="name_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="description"><?=lang("Site.description")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <textarea name="description" class="form-control" maxlength="255" placeholder="<?=lang("Site.description")?>" value=""></textarea>
                    <sub class="form-text text-danger error_field" id="description_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="picture"><?=lang("Site.picture")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input type="file" accept="image/*" name="picture" class="form-control" required>
                    <sub class="form-text text-danger error_field" id="picture_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <b><?=lang("Site.product_services_prices")?></b><br>
                    <p><span class="text-danger">Only fill prices for the services that apply to this products</sub></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-2"> 
                </div>
                <div class="col-12 col-md-10 d-flex justify-content-around"> 
                    <span><?=lang("Site.price")?></span>
                    <span>
                        <?=lang("Site.discount_price")?>
                    </span>
                </div>
            </div>
<?php
    foreach($product_services as $service):
?>
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="service_price"><?=$service['name']?></label>
                </div>
                <div class="col-12 col-md-10 input-group">
                    <input class="form-control" name="service_price[<?=$service['id']?>]" type="number" step="0.01" placeholder="<?=lang("Site.price")?>" value="">
                    <input class="form-control" name="service_discount_price[<?=$service['id']?>]" type="number" step="0.01" placeholder="<?=lang("Site.discount_price")?>" value="">
                    <sub class="form-text error_field text-danger" id="price_error"></sub>
                </div>
            </div>
<?php
    endforeach;
?>
        </div>

        <span class="text-success error_field" id="success"></span>
        <span class="text-danger error_field" id="error"></span>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.close")?></button>
            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('add_product')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view('includes/js/form')?>