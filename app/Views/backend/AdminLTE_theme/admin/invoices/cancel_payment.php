<div class="my-2">
    <span class="text-danger"><?=lang('Site.note')?>: <?=lang('Site.cancel_payment_notice')?></span>
    <form method="post" action="<?=fullUrl(route_to('admin_route_do_payment_cancel'))?>" id="cancel_invoice_form">
        <div class="card-body">
            <input type="hidden" class="form-control" name="invoice_id" value="<?=$invoice['id']?>">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3"> 
                        <label for="reference">
                            <?=lang("Site.invoice_id")?>
                        </label>
                    </div>
                    <div class="col-12 col-md-9"> 
                        <input type="text" class="form-control" name="reference" value="<?=$invoice['reference']?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3"> 
                        <label for="payment_status">
                            <?=lang("Site.payment_status")?>
                        </label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="cancelled"><?=lang("Site.cancelled")?></option>
                            <option value="failed"><?=lang("Site.failed")?></option>
                            <option value="refunded"><?=lang("Site.refunded")?></option>
                            <option value="unpaid" selected><?=lang("Site.unpaid")?></option>
                        </select>
                    </div>
                </div>
            </div>

            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('cancel_invoice_form')"><?=lang("Site.save")?></button>
        </div>
    </form>
</div>

<?=view('includes/js/form')?>