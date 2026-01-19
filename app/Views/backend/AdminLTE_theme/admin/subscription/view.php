<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><?=lang('Site.plan')?></strong></td>
                        <td>
                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_plan', $subscription['plan_id']))?>', `<?=lang('Site.plan_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.plan_details')?>">
                                <?=$subscription['plan_name']?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.subscriber')?></strong></td>
                        <td>
                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_user', $subscription['user_id']))?>', `<?=lang('Site.user_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.user_details')?>">
                                <?=$subscription['subscriber_name']?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.invoice_id')?></strong></td>
                        <td>
                            <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_view_invoice', $subscription['invoice_id']))?>', `<?=lang('Site.invoice_details')?>`)" data-toggle="tooltip" title="<?=lang('Site.invoice_details')?>">
                                <?=$subscription['invoice_id']?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.status')?></strong></td>
                        <td><?=lang('Site.'.$subscription['status'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.subscription_date')?></strong></td>
                        <td><?=formatDate($subscription["subscription_date"])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.renewal_date')?></strong></td>
                        <td><?=formatDate($subscription["renewal_date"])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.expiry_date')?></strong></td>
                        <td><?=formatDate($subscription["expiry_date"])?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>