<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_do_mark_invoice_as_paid'))?>" id="mark_as_paid_form">
        <div class="card-body">
            <input type="hidden" class="form-control" name="invoice_id" value="<?=$invoice['id']?>">
            <input type="hidden" class="form-control" name="status" value="paid">
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
                        <label for="total_paid">
                            <?=lang("Site.total_paid")?>
                        </label>
                    </div>
                    <div class="col-12 col-md-9"> 
                        <input type="number" class="form-control" name="total_paid" id="total_paid" value="<?=$invoice['total_paid']?>" required>
                        <sub class="text-danger error_field" id="total_paid_error"></sub> 
                        <input type="checkbox" name="ignore_less_price" value="1" id="ignore_less_price"> <?=lang('Site.ignore_lesser_price')?>      
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3"> 
                        <label for="">
                            <?=lang('Site.payment_method')?>
                        </label>
                    </div>
                    <div class="col-12 col-md-9"> 
                        <select name="payment_method" class="form-control" required>
                            <option value=""></option>
                        <?php
                            foreach($payment_methods as $method):
                        ?>
                            <option value="<?=$method['name']?>" <?=$method['name'] == $invoice['payment_method'] ? 'selected' : '' ?>><?=$method['name']?></option>
                        <?php
                            endforeach;
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3"> 
                        <label for="payment_reference">
                            <?=lang("Site.payment_reference")?>
                        </label>
                    </div>
                    <div class="col-12 col-md-9"> 
                        <input type="text" class="form-control" name="payment_reference" id="payment_reference" maxlength="255" value="<?=$invoice['payment_reference']?>">
                    </div>
                </div>
            </div>

            <span class="text-success error_field" id="success"></span>
            <span class="text-danger error_field" id="error"></span>          
            <button type="submit" class="btn btn-primary btn-block mt-2" id="form-submit" onclick="submitForm('mark_as_paid_form')"><?=lang("Site.mark_invoice_as_paid")?></button>
        </div>
    </form>
</div>

<?=view('includes/js/form')?>