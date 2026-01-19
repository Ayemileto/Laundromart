<?php
    foreach($subscription_cart as $cart):
    $delete_url = fullURL(route_to('user_route_delete_product_from_subscription_order',
                    $cart['subscription_id'],
                    $cart['product_id'],
                    $cart['product_service'],
            ));
?>
        <tr>
            <td><img src="<?=showProductImage($cart["file"])?>" alt="Product Image" height="25" width="25"></td>
            <td><?=$cart['product_name']?></td>
            <td><?=$cart['service_name']?></td>
            <td><?=$cart['quantity']?></td>
            <td>
                <a href="#" id='delete_product_<?=$cart['product_id']?>_<?=$cart['product_service']?>'
                 class="mx-1"
                 onclick="confirmModal('<?=$delete_url?>', this.id, true, '', 'tr', 'btn-danger')"
                 data-toggle="tooltip" title="<?=lang('Site.delete_product')?>">
                 <i class='fas fa-trash text-danger'></i></a>
            </td>
        </tr>
<?php
    endforeach;
?>