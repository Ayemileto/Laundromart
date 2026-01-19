<div class="my-2">
    <form enctype="multipart/form-data" method="post" action="<?=base_url().route_to('admin_route_update_product', $product["id"])?>" id="edit_product_form">
        <input type="hidden" name="product_id" class="form-control" value="<?=$product["id"]?>" required>
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="name"><?=lang("Site.product_name")?></label>
                </div>
                <div class="col-12 col-md-10"> 
                    <input class="form-control" name="name" type="text" maxlength="255" placeholder="<?=lang("Site.product_name")?>" value="<?=$product["name"]?>" required>
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
                    <textarea name="description" class="form-control" maxlength="255" placeholder="<?=lang("Site.description")?>" value=""><?=$product["description"]?></textarea>
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
                    <input type="checkbox" class="m-2" name="use_previous_image" id="use_previous_image" onchange="show_upload()" checked> <?=lang("Site.use_previous_image")?> 
                    <img src="<?=showProductImage($product["file"])?>" alt="Product Image" class="img-size-50 m-2">
                    <div id="upload_div" style="display:none;visibility:hidden;">
                        <input type="file" accept="image/*" name="picture" id="picture" class="form-control">
                    </div>
                    <sub class="form-text text-danger error_field" id="picture_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <b><?=lang("Site.product_services_prices")?></b><br>
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
        $prices             = array_column($product_prices, 'price', 'service_id');
        $discount_prices    = array_column($product_prices, 'discount_price', 'service_id');

?>
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="service_price"><?=$service['name']?></label>
                </div>
                <div class="col-12 col-md-10 input-group">
                    <input class="form-control" name="service_price[<?=$service['id']?>]" type="number" step="0.01" placeholder="<?=lang("Site.price")?>" value="<?=$prices[$service['id']] ?? ''?>">
                    <input class="form-control" name="service_discount_price[<?=$service['id']?>]" type="number" step="0.01" placeholder="<?=lang("Site.discount_price")?>" value="<?=$discount_prices[$service['id']] ?? ''?>">
                    <sub class="form-text error_field text-danger" id="price_error"></sub>
                </div>
            </div>
<?php
    endforeach;
?>
        </div>

        <span class="text-success error_field" id="success"></span>
        <span class="text-danger error_field" id="error_error"></span>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('edit_product_form')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view('includes/js/form')?>

<script>
    function show_upload()
    {
        if($("#use_previous_image").is(":checked"))
        {
            $("#upload_div").attr("style", "display:none;visibility:hidden;");
            $("#file_input").removeAttr("required");
        }
        else
        {
            $("#upload_div").removeAttr("style");
            $("#file_input").attr("required", true);
        }
    }
</script>