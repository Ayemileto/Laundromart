<style>
    .hide {
        display: none;
        visibility: hidden;
    }
</style>
<?=view('includes/css/select2')?>

<div class="content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <form method="post" action="<?=fullUrl(route_to('admin_route_save_invoice'))?>" id="create_invoice_form">
                    <div class="card-body"> 
                        <div class="form-group">
                            <label for="user">
                                <?=lang("Site.user_email")?>
                            </label>
                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_create_user'))?>', `<?=lang('Site.create_new_user')?>`)" class="btn btn-primary btn-xs float-right">
                                <?=lang('Site.create_new_user')?>
                            </a>
                            <select name="user" id="select_user" class="form-control select2bs4" data-placeholder="<?=lang('Site.type_user_email_to_search')?>" data-ajax--url="<?=fullUrl(route_to('admin_route_list_users_select2'))?>">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment_status">
                                <?=lang("Site.payment_status")?>
                            </label>
                            <select name="payment_status" id="payment_status" class="form-control select2bs4">
                                <option value="unpaid" selected><?=lang("Site.unpaid")?></option>
                                <option value="paid"><?=lang("Site.paid")?></option>
                                <option value="cancelled"><?=lang("Site.cancelled")?></option>
                                <option value="failed"><?=lang("Site.failed")?></option>
                                <option value="refunded"><?=lang("Site.refunded")?></option>
                            </select>
                        </div>

                        <div id="paid_inputs" class="hide">
                            <div class="form-group">
                                <label for="">
                                    <?=lang('Site.payment_method')?>
                                </label>
                                <select name="payment_method" class="form-control">
                                    <option value=""></option>
                        <?php
                            foreach($payment_methods as $method):
                        ?>
                                    <option value="<?=$method['name']?>" <?=$method['is_default'] == 'yes' ? 'selected' : '' ?>><?=$method['name']?></option>
                        <?php
                            endforeach;
                        ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="payment_reference">
                                    <?=lang("Site.payment_reference")?>
                                </label>
                                <input type="text" class="form-control" name="payment_reference" id="payment_reference" maxlength="255">
                            </div>
                        </div>
                    
                        <div class="form-group" id="extra_item">
                            <label for="items">
                                <?=lang("Site.items")?>
                            </label>
                            <div class="input-group my-2">
                                <div style="flex: 1;">
                                    <input type="text" name="items[]" id="items" class="form-control" placeholder="<?=lang('Site.item')?>" required>
                                </div>
                                <div style="flex: 1;">
                                    <input type="number" name="prices[]" id="prices" class="form-control" placeholder="<?=lang('Site.amount')?>" required>
                                </div>
                            </div>
                        </div>

                        <span class='btn btn-xs btn-primary float-right' onclick='addExtraItem()'><?=lang('Site.add_another_item')?></span>

                        <div class="input-group mb-3">
                            <sub class="form-text text-danger error_field" id="items_error"></sub>
                            <sub class="form-text text-danger error_field" id="prices_error"></sub>
                        </div>

                        <span class="text-success error_field" id="success"></span>
                        <span class="text-danger error_field" id="error"></span>          
                        <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('create_invoice_form')"><?=lang("Site.save")?></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $('#payment_status').change(function(){
        if($('#payment_status').val() == 'paid')
        {
            $('#paid_inputs').removeClass('hide');
        }
        else
        {
            $('#paid_inputs').addClass('hide');
        }
    });
</script>
<?=view(adminTheme().'/admin/invoices/form_js')?>
<?=view('includes/js/form')?>
<?=view('includes/js/select2')?>
<?=view('includes/js/modal')?>