<?=view('includes/css/select2')?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <form id="add_product_to_subscription_order" action="<?=fullUrl(route_to('user_route_add_product_to_subscription_order', $subscription_id))?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="product"><?=lang("Site.select_product")?></label>
                                <select name="product_id" id="select_product" class="form-control select2bs4">
                                    <option value=""></option>

                                <?php
                                    foreach($products as $product):
                                ?>
                                    <option value="<?=$product['id']?>"><?=$product['name']?></option>
                                <?php
                                    endforeach;
                                ?>

                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="service"><?=lang("Site.select_service")?></label>
                                <select name="product_service" id="select_service" class="form-control">


                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="quantity"><?=lang("Site.quantity")?></label>
                                <input name="quantity" class="form-control" type="number" min="1">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" onclick="submitForm('add_product_to_subscription_order')" id="form-submit"><?=lang('Site.add')?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?=lang('Site.order_summary')?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?=lang('Site.product')?></th>
                                        <th><?=lang('Site.service')?></th>
                                        <th><?=lang('Site.quantity')?></th>
                                        <th><?=lang('Site.actions')?></th>
                                    </tr>
                                </thead>
                                <tbody id="order_summary_table">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="<?=fullURL(route_to("user_route_checkout_subscription_order", $subscription_id))?>">
                                <button class="btn btn-primary float-right"><?=lang("Site.confirm_and_checkout")?></button>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#select_product').change(function() {
        $("#select_service").load(
            "<?=fullURL(route_to("select_option_product_services"))?>?product="+$('#select_product').val()
        );        
    });

    function RefreshProductSummaryTable()
    {
        $("#order_summary_table").load(
            "<?=fullURL(route_to("user_route_subscription_order_summary", $subscription_id))?>"
        );
    }

    $(function()
    {
        RefreshProductSummaryTable();
    });
</script>
<?=view('includes/js/select2')?>
<?=view('includes/js/form')?>
<?=view('includes/js/modal')?>