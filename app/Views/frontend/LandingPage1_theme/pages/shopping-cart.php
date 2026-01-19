<style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #fff;
            background-repeat: no-repeat
        }

        .plus-minus {
            position: relative
        }

        .plus {
            position: absolute;
            top: -4px;
            left: 2px;
            cursor: pointer
        }

        .minus {
            position: absolute;
            top: 8px;
            left: 5px;
            cursor: pointer
        }

        .vsm-text:hover {
            color: #FF5252
        }

        .book,
        .book-img {
            width: 120px;
            height: 180px;
            border-radius: 5px
        }

        .book {
            margin: 20px 15px 5px 15px
        }

        .border-top {
            border-top: 1px solid #EEEEEE !important;
            margin-top: 20px;
            padding-top: 15px
        }

        .card {
            margin: 40px 0px;
            padding: 40px 50px;
            border-radius: 20px;
            border: none;
            box-shadow: 1px 5px 10px 1px rgba(0, 0, 0, 0.2)
        }

        input,
        textarea {
            background-color: #F3E5F5;
            padding: 8px 15px 8px 15px;
            width: 100%;
            border-radius: 5px !important;
            box-sizing: border-box;
            border: 1px solid #F3E5F5;
            font-size: 15px !important;
            color: #000 !important;
            font-weight: 300
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #9FA8DA;
            outline-width: 0;
            font-weight: 400
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        @media screen and (max-width: 768px) {

            .book,
            .book-img {
                width: 100px;
                height: 150px
            }

            .card {
                padding-left: 15px;
                padding-right: 15px
            }

            .mob-text {
                font-size: 13px
            }

            .pad-left {
                padding-left: 20px
            }
        }
    </style>

    <div class="wrapper">
        <div class="container px-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <h4 class="heading"><?=lang('Site.product')?></h4>
                </div>
                <div class="col-7">
                    <div class="row text-right">
                        <div class="col-4 text-center">
                            <h6 class="mt-2"><?=lang('Site.price')?> (<?=currency()?>)</h6>
                        </div>
                        <div class="col-4 text-center">
                            <h6 class="mt-2"><?=lang('Site.qty')?></h6>
                        </div>
                        <div class="col-4 text-center">
                            <h6 class="mt-2"><?=lang('Site.total')?> (<?=currency()?>)</h6>
                        </div>
                    </div>
                </div>
            </div>
<?php
    $overall_total_price = 0;

    foreach($cart_data as $cart):
        $product_id       = $cart['product_id'];
        $product_service  = $cart['product_service'];

        $price            = formatProductServicePriceCart($cart['price'], $cart['discount_price']);
        $total_price      = $price * $cart['quantity'];

        $overall_total_price += $total_price;
?>
            <div class="row d-flex justify-content-center border-top" id="product_div_<?=$product_id?>_<?=$product_service?>">
                <div class="col-5">
                    <div class="row d-flex">
                        <div class="book text-center"> 
                            <img src="<?=showProductImage($cart["file"])?>" alt="Product Image" class="book-img">
                        </div>
                        <div class="my-auto flex-column d-flex pad-left">
                            <h6 class="mob-text">
                                <a href="#" onclick="showModal('<?=base_url().route_to('user_route_product_details', $product_id)?>', 'Product Details')">
                                    <?=$cart['name']?>
                                </a>
                            </h6>
                            <p class="mob-text">
                                (<?=$cart['service_name']?>)
                                <br>
                                <a href="#" id="remove_<?=$product_id?>_<?=$product_service?>" class="text-danger mx-auto" onclick="removeItem(this.id, <?=$product_id?>, <?=$product_service?>)" data-toggle="tooltip" title="Remove Product"><?=lang('Site.delete')?> <i class='fas fa-trash text-danger'></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="my-auto col-7">
                    <div class="row text-right">
                        <div class="col-4 text-center">
                            <p class="mob-text"><?=formatMoney($price)?></p>
                        </div>
                        <div class="col-4 text-center">
                            <div class="row d-flex justify-content-center px-3">
                                <p class="mb-0" id="cnt2">
                                    <span id="quantity_<?=$product_id?>_<?=$product_service?>">
                                        <?=$cart['quantity']?>
                                    </span>
                                    <span id="quantity_span_<?=$product_id?>_<?=$product_service?>"></span>
                                </p>
                                <div class="d-flex flex-column plus-minus">
                                    <span class="vsm-text plus mb-1 ml-1" onclick="changeQuantity(<?=$product_id?>, <?=$product_service?>, <?=$price?>, +1)"><i class="fas fa-plus"></i></span>
                                    <span class="vsm-text minus mt-1 ml-1" onclick="changeQuantity(<?=$product_id?>, <?=$product_service?>, <?=$price?>, -1)"><i class="fas fa-minus"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <!-- <h6 class="mob-text"><?=formatMoney($price)?></h6> -->
                            <h6 class="mob-text total_price" id="total_price_<?=$product_id?>_<?=$product_service?>">
                                <?=formatMoney($total_price)?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
<?php
    endforeach;
?>
            <div class="row justify-content-between mt-5 border-top">
                <div class="col-lg-3 my-1">
                    <a href="<?=fullUrl(route_to('products'))?>" class="btn-block btn btn-dark">
                        <span>
                            <?=lang('Site.continue_shopping')?>
                        </span>
                    </a>
                </div>
<?php if($overall_total_price > 0): ?>
                <div class="col-lg-3 my-1">
                    <a href="<?=fullUrl(route_to('user_route_checkout_products'))?>">
                        <button class="btn-block btn btn-primary">
                            <span>
                                <span id="confirm_button"><?=lang("Site.checkout")?></span>
                                (<span id="overall_total_price"><?=formatMoney($overall_total_price)?></span>)
                            </span>
                        </button>
                    </a>
                </div>
<?php endif; ?>
            </div>
        </div>
    </div>

<?=view('includes/js/modal')?>

<script>
    function disableConfirm(status)
    {
        $('#confirm_button').attr('disabled', status);
        if(status)
        {
            $('#confirm_button').html('Please wait ...');
        }
        else
        {
            $('#confirm_button').html('<?=lang('Site.checkout')?>');
        }
    }

    function removeItem($this, product_id, product_service)
    {
        $this = $('#'+$this);
        let $this_content = $this.html();

        $.ajax({
            url: '<?=fullUrl(route_to('user_route_remove_product_from_cart'))?>',
            method: 'post',
            dataType: 'json',
            data: {
                'product_id':product_id,
                'product_service':product_service,
            },

            beforeSend:function()
            {
                disableConfirm(true)
                $this.html("<i class='fas fa-spinner fa-spin text-primary'></i>");
            },

            success:function(data)
            {
                $('#product_div_'+product_id+'_'+product_service).remove();
                
                toastr.success(data.messages);
                updateTotals();
                $('#cart-item-count').html(data.cart);
            },

            error:function(data)
            {
                data=data.responseJSON;
                toastr.error(data.messages);
                $this.html($this_content);
            },

            complete:function()
            {
                disableConfirm(false)
            },
        });
    }


    function changeQuantity(product_id, product_service, unit_price, add)
    {
        quantity = parseInt($('#quantity_'+product_id+'_'+product_service).html());
        quantity += add;
        if(quantity < 1)
        {
            alert('<?=lang('Site.quantity_cannot_be_less_than_1')?>');
            return;
        }
        $.ajax({
            url: '<?=fullUrl(route_to('user_route_change_cart_product_quantity'))?>',
            method: 'post',
            dataType: 'json',
            data: {
                'product_id': product_id,
                'product_service': product_service,
                'quantity': quantity,
            },

            beforeSend:function()
            {
                disableConfirm(true);
                $('#quantity_span_'+product_id+'_'+product_service).html("<i class='fas fa-spinner fa-spin text-primary'></i>")
            },

            success:function(data)
            {
                toastr.success(data.messages);
                $('#quantity_'+product_id+'_'+product_service).html(quantity);
                $("#total_price_"+product_id+'_'+product_service).html(formatMoney(unit_price * quantity));
                updateTotals();
            },

            error:function(data)
            {
                data=data.responseJSON;
                toastr.error(data.messages);
            },

            complete:function(data)
            {
                disableConfirm(false)
                $('#quantity_span_'+product_id+'_'+product_service).html('');
            }
        });
    }

    function updateTotals()
    {
        let overall_total_price = 0; 
        $('.total_price').each(function(i, obj){
            total_price = $(this).html();
            total_price = total_price.replace(/[^\d\.\-]/g, '');
            overall_total_price += parseFloat(total_price);
        });

        $("#overall_total_price").html(formatMoney(overall_total_price))
    }
</script>