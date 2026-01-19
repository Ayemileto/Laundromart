        <div class="wrapper">
            <div class="container my-3">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center pt-3 pb-5">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary pricing-btn pricing-monthly-btn active" onclick="switchPricing('pricing-monthly')"><?=lang("Site.monthly")?></button>
                            <button type="button" class="btn btn-primary pricing-btn pricing-quarterly-btn" onclick="switchPricing('pricing-quarterly')"><?=lang("Site.quarterly")?></button>
                            <button type="button" class="btn btn-primary pricing-btn pricing-semi-annually-btn" onclick="switchPricing('pricing-semi-annually')"><?=lang("Site.semi_annually")?></button>
                            <button type="button" class="btn btn-primary pricing-btn pricing-yearly-btn" onclick="switchPricing('pricing-yearly')"><?=lang("Site.yearly")?></button>
                        </div>
                    </div>
                    <div class="card-deck mb-3 text-center">
                        <?php
                            foreach($plans as $plan):
                        ?>
                        
                            <div class="card mb-4 box-shadow">
                                <div class="card-header bg-primary text-white p-3 border-0">
                                    <h4 class="mt-3 font-weight-bolder"><?=$plan['name']?></h4>
                                    <p><?=$plan['tagline']?></p>
                                </div>
                                <div class="card-body">
                                    <h2 class="card-title pricing-card-title pricing pricing-monthly"><span class="text-primary"><?=formatMoney($plan['monthly_price'])?></span> <sub class="text-muted">/<?=lang('Site.month')?></sub></h2>
                                    <h2 class="card-title pricing-card-title pricing pricing-quarterly d-none"><span class="text-primary"><?=formatMoney($plan['quarterly_price'])?></span> <sub class="text-muted">/<?=lang('Site.quarter')?></sub></h2>
                                    <h2 class="card-title pricing-card-title pricing pricing-semi-annually d-none"><span class="text-primary"><?=formatMoney($plan['semi_annually_price'])?></span> <sub class="text-muted">/<?=lang('Site.semi_annual')?></sub></h2>
                                    <h2 class="card-title pricing-card-title pricing pricing-yearly d-none"><span class="text-primary"><?=formatMoney($plan['yearly_price'])?></span> <sub class="text-muted">/<?=lang('Site.year')?></sub></h2>

                                    <ul class="list-unstyled mt-3 plan-features">
                            <?php
                                $plan_features = explode(';;', $plan['features']);
                                
                                foreach($plan_features as $feature):
                            ?>
                                            <li><?=$feature?></li>
                            <?php
                                endforeach;
                            ?>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <a href='<?=fullUrl(route_to('user_route_subscribe', $plan['id']))?>?period=monthly' type="button" class="btn btn-lg btn-block btn-primary sbtn pricing-monthly-sbtn"><?=lang('Site.subscribe')?></a>
                                    <a href='<?=fullUrl(route_to('user_route_subscribe', $plan['id']))?>?period=quarterly' type="button" class="btn btn-lg btn-block btn-primary d-none sbtn pricing-quarterly-sbtn"><?=lang('Site.subscribe')?></a>
                                    <a href='<?=fullUrl(route_to('user_route_subscribe', $plan['id']))?>?period=semi-annually' type="button" class="btn btn-lg btn-block btn-primary d-none sbtn pricing-semi-annually-sbtn"><?=lang('Site.subscribe')?></a>
                                    <a href='<?=fullUrl(route_to('user_route_subscribe', $plan['id']))?>?period=yearly' type="button" class="btn btn-lg btn-block btn-primary d-none sbtn pricing-yearly-sbtn"><?=lang('Site.subscribe')?></a>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>

    <script>
        function switchPricing(pricing)
        {
            $(".pricing").addClass('d-none');
            $("."+pricing).removeClass('d-none');
            $(".pricing-btn").removeClass('active');
            $("."+pricing+"-btn").addClass('active');
            $(".sbtn").addClass('d-none');
            $("."+pricing+"-sbtn").removeClass('d-none');
        }
    </script>