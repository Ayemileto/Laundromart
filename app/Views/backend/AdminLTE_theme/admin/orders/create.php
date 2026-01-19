<?=view('includes/css/select2')?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_id">
                                    <?=lang("Site.user_email")?>
                                </label>
                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_create_user'))?>', `<?=lang('Site.create_new_user')?>`)" class="btn btn-primary btn-xs float-right">
                                    <?=lang('Site.create_new_user')?>
                                </a>
                                <select name="user_id" id="select_user" class="form-control select2bs4" data-placeholder="<?=lang('Site.type_user_email_to_search')?>" data-ajax--url="<?=fullUrl(route_to('admin_route_list_users_select2'))?>">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card-primary">
                    <form id="add_product_to_order" action="<?=fullUrl(route_to('admin_route_add_product_to_order'))?>" method="post">
                        <input type="hidden" name="user" id="selected_user">
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
                                <select name="product_service" id="select_service" class="form-control select2bs4">


                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="quantity"><?=lang("Site.quantity")?></label>
                                <input name="quantity" class="form-control" type="number" min="1">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary float-right" onclick="submitForm('add_product_to_order')" id="form-submit"><?=lang('Site.add')?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?=lang('Site.user_cart')?></h3>
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
                                <tbody id="user_cart_summary_table">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="<?=fullURL(route_to("admin_route_checkout_order"))?>">
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

    $('#select_user').change(function() {
        user_id = $('#select_user').val();

        $("#selected_user").val(user_id);

        if(!isNaN(user_id))
        {
            RefreshUserCartSummaryTable(user_id);
        }
    });

    function RefreshUserCartSummaryTable(user_id)
    {
        $("#user_cart_summary_table").load(
            "<?=fullURL(route_to("admin_route_user_cart_summary"))?>?user="+user_id
        );
    }
</script>
<?=view('includes/js/select2')?>
<?=view('includes/js/form')?>
<?=view('includes/js/modal')?>