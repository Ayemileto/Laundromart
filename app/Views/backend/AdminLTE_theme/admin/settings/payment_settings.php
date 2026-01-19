    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#paymentDefaultSettings" data-toggle="tab"><?=lang("Site.default_gateway")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#paymentCashSettings" data-toggle="tab"><?=lang("Site.cash")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#paymentPaypalSettings" data-toggle="tab"><?=lang("Site.payment_paypal_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#paymentStripeSettings" data-toggle="tab"><?=lang("Site.payment_stripe_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#paymentFlutterwaveSettings" data-toggle="tab"><?=lang("Site.payment_flutterwave_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#paymentPaystackSettings" data-toggle="tab"><?=lang("Site.payment_paystack_settings")?></a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="paymentDefaultSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_default_gateway_settings'))?>" id="paymentDefaultSettingsForm">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="is_default"><?=lang("Site.default_gateway")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select name="is_default" class="form-control">
                                                    <option value=""></option>
                                                    <?php
                                                        foreach($payment_gateways as $gateway):
                                                    ?>
                                                        <option value="<?=$gateway['id']?>" <?=($gateway['is_default'] == 'yes') ? 'selected' : ''?>><?=$gateway['name']?></option>
                                                    <?php
                                                        endforeach;
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field"></span>
                                        <span class="text-danger error_field"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('paymentDefaultSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="tab-pane" id="paymentCashSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_payment_settings'))?>" id="paymentCashSettingsForm">
                                        <input type="hidden" name="id" value="<?=$cash['id']?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="is_enabled"><?=lang("Site.is_enabled")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select name="is_enabled" class="form-control">
                                                        <option value="yes" <?=$cash['is_enabled'] == 'yes' ? 'selected' : ''?>><?=lang('Site.yes')?></option>
                                                        <option value="no" <?=$cash['is_enabled'] != 'yes' ? 'selected' : ''?>><?=lang('Site.no')?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field"></span>
                                        <span class="text-danger error_field"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('paymentCashSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="tab-pane" id="paymentPaypalSettings">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                            </div>
                                        <div class="col-12 col-md-10">
                                            <b>If you choose to use Paypal Webhook, ensure you enable notifications for the following event types:
                                            <li>Checkout order approved</li>
                                            <li>Payment capture completed</li>
                                            <br>
                                             Your WEBHOOK URL is: <span class="text-primary"><?=fullUrl(route_to('payment_webhook_url', 'paypal'))?></span></b>
                                            <br><br>
                                        </div>
                                    </div>
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_payment_settings'))?>" id="paymentPaypalSettingsForm">
                                        <input type="hidden" name="id" value="<?=$paypal['id']?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="is_enabled"><?=lang("Site.is_enabled")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select name="is_enabled" class="form-control">
                                                        <option value="yes" <?=$paypal['is_enabled'] == 'yes' ? 'selected' : ''?>><?=lang('Site.yes')?></option>
                                                        <option value="no" <?=$paypal['is_enabled'] != 'yes' ? 'selected' : ''?>><?=lang('Site.no')?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="public_key"><?=lang("Site.client_id")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="public_key" name="public_key" placeholder="<?=lang("Site.public_key")?>" value="<?=$paypal['public_key']?>" required>
                                                    <sub class="error_field text-danger" id="public_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="secret_key"><?=lang("Site.secret_key")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="secret_key" name="secret_key" placeholder="<?=lang("Site.secret_key")?>" value="<?=$paypal['secret_key']?>" required>
                                                    <sub class="error_field text-danger" id="secret_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="webhook_key"><?=lang("Site.webhook_id")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="webhook_key" name="webhook_key" placeholder="<?=lang("Site.webhook_id")?>" value="<?=$paypal['webhook_key']?>">
                                                    <sub class="error_field text-danger" id="webhook_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="currency"><?=lang("Site.currency")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="currency" name="currency" placeholder="<?=lang("Site.currency")?>" value="<?=$paypal['currency']?>" required>
                                                    <sub class="error_field text-danger" id="currency_error"></sub>
                                                    <sub class="text-danger">Currency Code as required on the platform. for example, USD, EUR</sub>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field"></span>
                                        <span class="text-danger error_field"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('paymentPaypalSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="paymentStripeSettings">
                                    <div class="row">
                                        <div class="col-12 col-md-2"> 
                                         </div>
                                        <div class="col-12 col-md-10">
                                            <b>In order to use Stripe Checkout, you must set an account or business name at <a href="https://dashboard.stripe.com/account" target="_blank">https://dashboard.stripe.com/account</a>.</b><br>
                                            <b>You must also setup your webhook endpoint in the "Developers => Webhooks" section.<br>
                                             Your WEBHOOK URL is: <span class="text-primary"><?=fullUrl(route_to('payment_webhook_url', 'stripe'))?></span></b>
                                            <br>
                                            <b>Under "Events to listen to", Select "Checkout" => "Select all Checkout events". then click "Add events", and Save.</b>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_payment_settings'))?>" id="paymentStripeSettingsForm">
                                        <input type="hidden" name="id" value="<?=$stripe['id']?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="is_enabled"><?=lang("Site.is_enabled")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select name="is_enabled" class="form-control">
                                                        <option value="yes" <?=$stripe['is_enabled'] == 'yes' ? 'selected' : ''?>><?=lang('Site.yes')?></option>
                                                        <option value="no" <?=$stripe['is_enabled'] != 'yes' ? 'selected' : ''?>><?=lang('Site.no')?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="public_key"><?=lang("Site.publishable_key")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="public_key" name="public_key" placeholder="<?=lang("Site.publishable_key")?>" value="<?=$stripe['public_key']?>" required>
                                                    <sub class="error_field text-danger" id="public_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="secret_key"><?=lang("Site.secret_key")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="secret_key" name="secret_key" placeholder="<?=lang("Site.secret_key")?>" value="<?=$stripe['secret_key']?>" required>
                                                    <sub class="error_field text-danger" id="secret_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="webhook_key"><?=lang("Site.endpoint_secret")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="webhook_key" name="webhook_key" placeholder="<?=lang("Site.webhook_key")?>" value="<?=$stripe['webhook_key']?>" required>
                                                    <sub class="error_field text-danger" id="webhook_key_error"></sub>
                                                    <sub class="text-danger">You can find your endpoint's secret in your webhook settings (it's called "Signing secret")</sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="currency"><?=lang("Site.currency")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="currency" name="currency" placeholder="<?=lang("Site.currency")?>" value="<?=$stripe['currency']?>" required>
                                                    <sub class="error_field text-danger" id="currency_error"></sub>
                                                    <sub class="text-danger">Currency Code as required on the platform. for example, USD, EUR</sub>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field"></span>
                                        <span class="text-danger error_field"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('paymentStripeSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>

                                </div>

                                <div class="tab-pane" id="paymentFlutterwaveSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_payment_settings'))?>" id="paymentFlutterwaveSettingsForm">
                                        <input type="hidden" name="id" value="<?=$flutterwave['id']?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="is_enabled"><?=lang("Site.is_enabled")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select name="is_enabled" class="form-control">
                                                        <option value="yes" <?=$flutterwave['is_enabled'] == 'yes' ? 'selected' : ''?>><?=lang('Site.yes')?></option>
                                                        <option value="no" <?=$flutterwave['is_enabled'] != 'yes' ? 'selected' : ''?>><?=lang('Site.no')?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="public_key"><?=lang("Site.public_key")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="public_key" name="public_key" placeholder="<?=lang("Site.public_key")?>" value="<?=$flutterwave['public_key']?>" required>
                                                    <sub class="error_field text-danger" id="public_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="secret_key"><?=lang("Site.secret_key")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="secret_key" name="secret_key" placeholder="<?=lang("Site.secret_key")?>" value="<?=$flutterwave['secret_key']?>" required>
                                                    <sub class="error_field text-danger" id="secret_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="currency"><?=lang("Site.currency")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="currency" name="currency" placeholder="<?=lang("Site.currency")?>" value="<?=$flutterwave['currency']?>" required>
                                                    <sub class="error_field text-danger" id="currency_error"></sub>
                                                    <sub class="text-danger">Currency Code as required on the platform. for example, USD, EUR</sub>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field"></span>
                                        <span class="text-danger error_field"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('paymentFlutterwaveSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="paymentPaystackSettings">
                                    <form method="post" action="<?=fullUrl(route_to('admin_route_save_payment_settings'))?>" id="paymentPaystackSettingsForm">
                                        <input type="hidden" name="id" value="<?=$paystack['id']?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="is_enabled"><?=lang("Site.is_enabled")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <select name="is_enabled" class="form-control">
                                                        <option value="yes" <?=$paystack['is_enabled'] == 'yes' ? 'selected' : ''?>><?=lang('Site.yes')?></option>
                                                        <option value="no" <?=$paystack['is_enabled'] != 'yes' ? 'selected' : ''?>><?=lang('Site.no')?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="public_key"><?=lang("Site.public_key")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="public_key" name="public_key" placeholder="<?=lang("Site.public_key")?>" value="<?=$paystack['public_key']?>" required>
                                                    <sub class="error_field text-danger" id="public_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="secret_key"><?=lang("Site.secret_key")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="secret_key" name="secret_key" placeholder="<?=lang("Site.secret_key")?>" value="<?=$paystack['secret_key']?>" required>
                                                    <sub class="error_field text-danger" id="secret_key_error"></sub>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12 col-md-2"> 
                                                    <label for="currency"><?=lang("Site.currency")?></label>
                                                </div>
                                                <div class="col-12 col-md-10"> 
                                                    <input type="text" class="form-control" id="currency" name="currency" placeholder="<?=lang("Site.currency")?>" value="<?=$paystack['currency']?>" required>
                                                    <sub class="error_field text-danger" id="currency_error"></sub>
                                                    <sub class="text-danger">Currency Code as required on the platform. for example, USD, EUR</sub>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="text-success error_field"></span>
                                        <span class="text-danger error_field"></span>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('paymentPaystackSettingsForm')"><?=lang("Site.save")?></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?=view('includes/js/form')?>