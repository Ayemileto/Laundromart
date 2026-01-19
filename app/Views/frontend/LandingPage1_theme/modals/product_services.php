    <form action="<?=fullUrl(route_to('user_route_add_product_to_cart'))?>" id="product_form" method="post">
        <input type="hidden" name="product_id" value="<?=$product['id']?>">
<?php
    foreach($product_services as $service):
        $service_id  = $service['service_id'];
?>
                <div class="form-check">
                    <input type="radio" name="product_service" id="ps_<?=$service_id?>" class="form-check-input" value="<?=$service_id?>">
                    <label for="ps_<?=$service_id?>" class="form-check-label d-flex">
                        <?=$service['name']?> 
                        <span class="ml-auto">
                            <?=formatProductServicePrice($service['price'], $service['discount_price'])?>
                        </span>
                    </label>
                </div>
<?php
    endforeach;
?>
        <div class="input-group py-3">
            <div class="input-group-prepend">
                <label class="input-group-text"><?=lang('Site.quantity')?></label>
            </div>
            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 submit" id="form-submit" onclick="submitForm('product_form')">Add to Cart</button>
    </form>

<?=view('includes/js/form')?>