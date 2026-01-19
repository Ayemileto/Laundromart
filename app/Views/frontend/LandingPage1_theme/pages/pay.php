        <div class="wrapper">
            <div class="container my-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-1g-6">
                        <form action="" method="post" class="bg-light p-5">
                            <h4 class="text-center pb-4"><?=lang('Site.payment_summary')?></h4>
                            <input type="hidden" name="reference" value="<?=$invoice['reference']?>"> 
                            <input type="hidden" name="invoice_id" value="<?=$e_invoice?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label for=""><?=lang('Site.invoice_id')?></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" class="form-control" value="<?=$invoice['reference']?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label for=""><?=lang('Site.total_due')?></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" class="form-control" value="<?=$invoice['total_due']?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-12 col-md-3"> 
                                        <label for=""><?=lang('Site.payment_method')?></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="payment_method" class="form-control" required>
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
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"><?=lang("Site.pay")?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>