<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="post" action="<?=fullUrl(route_to('admin_route_save_item_to_invoice'))?>" id="add_item_form">
                <input type="hidden" name="invoice_id" value="<?=$invoice['id']?>">
                <div class="card-body">
                
                    <div id="extra_item">
                        <div class="input-group my-2">
                            <div style="flex: 1;">
                                <input type="text" name="items[]" maxlength="255" id="items" class="form-control" placeholder="<?=lang('Site.item')?>" required>
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
                    <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('add_item_form')"><?=lang("Site.save")?></button>
                </div>
            </form>

        </div>
    </div>
</div>

<?=view(adminTheme().'/admin/invoices/form_js')?>
<?=view('includes/js/form')?>