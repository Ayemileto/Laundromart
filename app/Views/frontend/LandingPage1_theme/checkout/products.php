<?=view('includes/css/select2')?>

        <section id="checkout-container" class="wrapper">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted"><?=lang("Site.summary")?></span>
                            <span class="badge badge-secondary badge-pill"><?=count($cart_data)?></span>
                        </h4>
                        <ul class="list-group mb-3">
                        <?php
                            $overall_total_price = 0;
                            foreach($cart_data as $cart)
                            {
                                $price            = formatProductServicePriceCart($cart['price'], $cart['discount_price']);
                                $total_price      = $price * $cart['quantity'];
                                $overall_total_price += $total_price;
                        ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?=$cart['name']?></h6>
                                    <small class="text-muted"><?=$cart['service_name']?></small>
                                </div>
                                <span class="text-muted"><?=formatMoney($total_price)?></span>
                            </li>
                        <?php
                            }
                        ?>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="">
                                    <h6 class="my-0"><?=lang('Site.shipping')?></h6>
                                </div>
                                <span class="text-success" id="shipping_fee"><?=formatMoney(0)?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?=lang('Site.total')?></span>
                                <strong class="overall_total_price" id="overall_total_price" data-overall_total="<?=$overall_total_price?>"><?=formatMoney($overall_total_price)?></strong>
                            </li>
                        </ul>
                        <!-- <form class="card p-2">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">Redeem</button>
                                </div>
                            </div>
                        </form> -->
                    </div>
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3"><?=lang("Site.shipping")?></h4>
                        <form action="" method="post" id="shipping-form">
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="self_pickup" name="pickup_type" type="radio" class="custom-control-input pickup_type" value="self" checked required>
                                    <label class="custom-control-label" for="self_pickup"><?=lang("Site.self_dropoff_and_pickup")?></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="company_pickup" name="pickup_type" type="radio" class="custom-control-input pickup_type" value="company" required>
                                    <label class="custom-control-label" for="company_pickup"><?=lang("Site.company_pickup_and_or_dropoff")?></label>
                                </div>
                            </div>

                            <div id="shipping-details" class="hide mt-5">
                                <h4 class="mb-3"><?=lang("Site.shipping_details")?></h4>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName"><?=lang("Auth.firstname")?></label>
                                        <input type="text" class="form-control required" id="firstname" name="firstname" placeholder="<?=lang("Auth.firstname")?>" value="<?=firstName()?>">
                                        <small class="text-danger error_field" id="firstname_error"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName"><?=lang("Auth.lastname")?></label>
                                        <input type="text" class="form-control required" id="lastname" name="lastname" placeholder="<?=lang("Auth.lastname")?>" value="<?=lastName()?>">
                                        <small class="text-danger error_field" id="lastname_error"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="shipping_type"><?=lang("Site.shipping_type")?></label>
                                        <select class="custom-select d-block w-100 select2bs4 required" id="shipping_type" name="shipping_type" required>
                                            <option value="pickup_only"><?=lang('Site.pickup_only')?></option>
                                            <option value="delivery_only"><?=lang('Site.delivery_only')?></option>
                                            <option value="pickup_delivery" selected><?=lang('Site.pickup_delivery')?></option>
                                        </select>
                                        <small class="text-danger error_field" id="shipping_type_error"></small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="zipcode"><?=lang("Site.zipcode")?> / <?=lang("Site.area")?></label>
                                        <select class="custom-select d-block w-100 select2bs4 required" id="zipcode" name="zipcode" data-ajax--url="<?=fullUrl(route_to('search-zipcodes'))?>">
                                            <option value=""></option>
                                        </select>
                                        <small class="text-danger error_field" id="zipcode_error"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="address"><?=lang("Site.address")?></label>
                                        <input type="text" class="form-control required" id="address" name="address" placeholder="<?=lang("Site.address")?>">
                                        <small class="text-danger error_field" id="address_error"></small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="address2"><?=lang("Site.address_2")?>
                                            <span class="text-muted">(<?=lang("Site.optional")?>)</span>
                                        </label>
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="<?=lang("Site.address_2")?>">
                                        <small class="text-danger error_field" id="address2_error"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pickup_date"><?=lang("Site.pickup_date")?></label>
                                        <input class="form-control" type="date" id="pickup_date" name="pickup_date" placeholder="<?=lang("Site.pickup_date")?>">
                                        <small class="text-danger error_field" id="pickup_date_error"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pickup_time"><?=lang("Site.pickup_time")?></label>
                                        <input class="form-control" type="time" id="pickup_time" name="pickup_time" placeholder="<?=lang("Site.pickup_time")?>" disabled>
                                        <small class="text-danger error_field" id="pickup_time_error"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="delivery_date"><?=lang("Site.delivery_date")?></label>
                                        <input class="form-control" type="date" id="delivery_date" name="delivery_date" placeholder="<?=lang("Site.delivery_date")?>">
                                        <small class="text-danger error_field" id="delivery_date_error"></small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="delivery_time"><?=lang("Site.delivery_time")?></label>
                                        <input class="form-control" type="time" id="delivery_time" name="delivery_time" placeholder="<?=lang("Site.delivery_time")?>" disabled>
                                        <small class="text-danger error_field" id="delivery_time_error"></small>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit">
                                <?=lang("Site.confirm_and_pay")?>
                                <span class="ml-3">
                                    (<strong class="overall_total_price"><?=formatMoney($overall_total_price)?></strong>)
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- <div class="wrapper">

        </div> -->

             
        <script>
            $('input[type=radio][name=pickup_type]').change(function() {
                if (this.value == 'self') {
                    $("#shipping-details").addClass("hide");
                    $("#shipping-details").find(".required").removeAttr("required");
                }
                else {
                    $("#shipping-details").removeClass("hide");
                    $("#shipping-details").find(".required").attr("required", true);
                }
            });
        </script>

        <script>
            $("#zipcode,#shipping_type").on("change", function() {
                let zip_data=$("#zipcode").val();
                if(zip_data != '')
                {
                    zip_data = JSON.parse(zip_data);

                    let delivery_only_price = zip_data.delivery_only_price;
                    let pickup_only_price = zip_data.pickup_only_price;
                    let pickup_delivery_price = zip_data.pickup_delivery_price;

                    let overall_total = parseFloat($("#overall_total_price").data("overall_total"));

                    if($("#shipping_type").val() == "delivery_only")
                    {
                        shipping_fee = delivery_only_price;
                        overall_total += parseFloat(delivery_only_price);
                    }
                    else if($("#shipping_type").val() == "pickup_only")
                    {
                        shipping_fee = pickup_only_price;
                        overall_total += parseFloat(pickup_only_price);
                    }
                    else
                    {
                        shipping_fee = pickup_delivery_price;
                        overall_total += parseFloat(pickup_delivery_price);
                    }
                    
                    if(!isNaN(shipping_fee))
                    {
                        $("#shipping_fee").html(formatMoney(shipping_fee));
                        $(".overall_total_price").html(formatMoney(overall_total));
                    }
                }
// alert(444);
//                     alert(zip_data['delivery_only_price']);

                // let delivery_only_price = $("#zipcode").find(":selected").data("delivery_only_price");
                // let pickup_only_price = $("#zipcode").find(":selected").data("pickup_only_price");
                // let pickup_delivery_price = $("#zipcode").find(":selected").data("pickup_delivery_price");

                // if($("#shipping_type").val() == "delivery_only")
                // {
                //     shipping_fee = delivery_only_price;
                //     overall_total += parseFloat(delivery_only_price);
                // }
                // else if($("#shipping_type").val() == "pickup_only")
                // {
                //     shipping_fee = pickup_only_price;
                //     overall_total += parseFloat(pickup_only_price);
                // }
                // else
                // {
                //     shipping_fee = pickup_delivery_price;
                //     overall_total += parseFloat(pickup_delivery_price);
                // }

                // if(!isNaN(shipping_fee))
                // {
                //     $("#shipping_fee").html(formatMoney(shipping_fee));
                //     $(".overall_total_price").html(formatMoney(overall_total));
                // }
            });
        </script>
<?=view('includes/js/select2')?>

<script>
    $('#mySelect2').select2({
        ajax: {
            url: 'https://api.github.com/orgs/select2/repos',
            data: function (params) {
            var query = {
                search: params.term,
                type: 'public'
            }

            // Query parameters will be ?search=[term]&type=public
            return query;
            }
        }
    });
</script>

<script>
    $("#pickup_date").change(function() {
        $("#pickup_time").attr('disabled', true);
        $("#pickup_time_error").html('');

        let pickup_date = $("#pickup_date").val();

        $.post("<?=fullUrl(route_to('check_pickup_date'))?>", {pickup_date: pickup_date}, function(result){
            if(result.is_valid)
            {
                $("#pickup_time").removeAttr('disabled');
                $("#pickup_time").attr('min', result.min);
                $("#pickup_time").attr('max', result.max);
                $("#pickup_time_error").html('<?=lang('Site.pickup_time')?> '+ result.min +' - '+ result.max);
            }
            else
            {
                alert("<?=lang('Site.pickup_not_available_on_selected_date')?>");
            }
        }, "json");
    });

    $("#delivery_date").change(function() {
        $("#delivery_time").attr('disabled', true);
        $("#delivery_time_error").html('');

        let delivery_date = $("#delivery_date").val();

        $.post("<?=fullUrl(route_to('check_delivery_date'))?>", {delivery_date: delivery_date}, function(result){
            if(result.is_valid)
            {
                $("#delivery_time").removeAttr('disabled');
                $("#delivery_time").attr('min', result.min);
                $("#delivery_time").attr('max', result.max);
                $("#delivery_time_error").html('<?=lang('Site.delivery_time')?> '+ result.min +' - '+ result.max);
            }
            else
            {
                alert("<?=lang('Site.delivery_not_available_on_selected_date')?>");
            }
        }, "json");
    });
</script>
<?php
//echo "<pre>";
//var_dump($cart_data);

//table.table-responsive