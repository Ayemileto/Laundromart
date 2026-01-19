
<table style="margin-bottom: 32px; width: 100%;" cellpadding="0" cellspacing="0" role="presentation">
    <thead>
    </thead>
    <tbody>
        <tr>
            <td><strong><?=lang('Site.plan')?></strong></td>
            <td>
                <?=$subscription['plan_name']?>
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
            <td><strong><?=lang('Site.expiry_date')?></strong></td>
            <td><?=formatDate($subscription["expiry_date"])?></td>
        </tr>
    </tbody>
</table>