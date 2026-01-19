<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><strong><?=lang('Site.plan_name')?></strong></td>
                        <td><?=$plan['name']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.tagline')?></strong></td>
                        <td><?=$plan['tagline']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.monthly_price')?></strong></td>
                        <td><?=formatMoney($plan['monthly_price'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.quarterly_price')?></strong></td>
                        <td><?=formatMoney($plan['quarterly_price'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.semi_annually_price')?></strong></td>
                        <td><?=formatMoney($plan['semi_annually_price'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.yearly_price')?></strong></td>
                        <td><?=formatMoney($plan['yearly_price'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.features')?></strong></td>
                        <td>
                        <?php 
                            $features = explode(";;", $plan["features"]);
                            foreach ($features AS $feature):
                                if(!empty($feature)):
                        ?>
                                    <p><?=$feature?></p>
                        <?php
                                endif; 
                            endforeach;
                        ?>
                        
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.status')?></strong></td>
                        <td><?=$plan['status']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>