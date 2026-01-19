<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><strong><?=lang('Site.invoice_id')?></strong></td>
                            <td><?=$invoice['reference']?></td>
                        </tr>
                        <tr>
                            <td><strong><?=lang('Site.total_price')?></strong></td>
                            <td><?=formatMoney($invoice['total_price'])?></td>
                        </tr>
                        <tr>
                            <td><strong><?=lang('Site.tax')?></strong></td>
                            <td><?=formatMoney($invoice['tax'])?></td>
                        </tr>
                        <tr>
                            <td><strong><?=lang('Site.total_due')?></strong></td>
                            <td><?=formatMoney($invoice['total_due'])?></td>
                        </tr>
                        <tr>
                            <td><strong><?=lang('Site.total_paid')?></strong></td>
                            <td><?=formatMoney($invoice['total_paid'])?></td>
                        </tr>
                        <tr>
                            <td><strong><?=lang('Site.payment_method')?></strong></td>
                            <td><?=$invoice['payment_method']?></td>
                        </tr>
                        <tr>
                            <td><strong><?=lang('Site.payment_reference')?></strong></td>
                            <td><?=$invoice['payment_reference']?></td>
                        </tr>
                        <tr>
                            <td><strong><?=lang('Site.payment_status')?></strong></td>
                            <td><?=lang('Site.'.$invoice['status'])?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="text-center">
    <?php
        if($invoice['status'] != 'paid'):
    ?>
                <!-- <div> -->
                <a href="<?=fullUrl(route_to('pay_invoice', $invoice['reference']))?>" class="btn btn-primary mx-auto"><?=lang('Site.click_here_to_pay')?></a>
                <h2 class="my-2 text-uppercase"><?=lang('Site.or')?></h2>
                <span><?=lang('Site.scan_to_pay')?></span>
                <div id="qrcode" class="mt-3"></div>
                <!-- </div> -->
    <?php
        endif;
    ?>
            </div>
            </div>
            <div class="col-12 pt-3">
                <h2><?=lang('Site.items')?></h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?=lang('Site.name')?></th>
                            <th><?=lang('Site.quantity')?></th>
                            <th><?=lang('Site.unit_price')?></th>
                            <th><?=lang('Site.total_price')?></th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
        $items = json_decode($invoice['items'], true);

        if(!empty($items['items']))
        {
            foreach($items['items'] as $item)
            {
    ?>
                        <tr>
                            <td><?=$item['name']?></td>
                            <td><?=$item['quantity']?></td>
                            <td><?=formatMoney($item['unit_price'])?></td>
                            <td><?=formatMoney($item['total_price'])?></td>
                        </tr>
    <?php
            }
        }
        if(!empty($items['subscription']))
        {
    ?>
                        <tr>
                            <td><?=$items['subscription']['name']?></td>
                            <td><?=$items['subscription']['duration']?></td>
                            <td><?=formatMoney($items['subscription']['unit_price'])?></td>
                            <td><?=formatMoney($items['subscription']['total_price'])?></td>
                        </tr>
    <?php
        }
        if(!empty($items['shipping']))
        {
    ?>
                        <tr>
                            <td><?=$items['shipping']['item_name']?></td>
                            <td>1</td>
                            <td><?=formatMoney($items['shipping']['shipping_fee'])?></td>
                            <td><?=formatMoney($items['shipping']['shipping_fee'])?></td>
                        </tr>
    <?php
        }
        if(!empty($items['custom_items']))
        {
            foreach($items['custom_items'] as $custom_item){
    ?>
                        <tr>
                            <td>
                                <?=$custom_item['name']?>
                            </td>
                            <td>1</td>
                            <td><?=formatMoney($custom_item['price'])?></td>
                            <td><?=formatMoney($custom_item['price'])?></td>
                        </tr>
    <?php
            }
        }
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?=view('includes/js/qrcode.php')?>
<script>
    $(function(){
        showQRCode("<?=fullUrl(route_to('pay_invoice', $invoice['reference']))?>", "qrcode");
    });
</script>