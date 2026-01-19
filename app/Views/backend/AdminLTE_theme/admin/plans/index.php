    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span><?=$title?></span>
                            <span class="float-sm-right">
                                <button class="btn btn-primary" onclick="showModal('<?=base_url().route_to('admin_route_add_plan')?>', `<?=lang('Site.add_plan')?>`)"><?=lang('Site.add_plan')?></button>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center mb-3">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-primary pricing-btn active" onclick="switchPricing('pricing-monthly')"><?=lang("Site.monthly")?></button>
                                        <button type="button" class="btn btn-primary pricing-btn" onclick="switchPricing('pricing-quarterly')"><?=lang("Site.quarterly")?></button>
                                        <button type="button" class="btn btn-primary pricing-btn" onclick="switchPricing('pricing-semi-annually')"><?=lang("Site.semi_annually")?></button>
                                        <button type="button" class="btn btn-primary pricing-btn" onclick="switchPricing('pricing-yearly')"><?=lang("Site.yearly")?></button>
                                    </div>
                                </div>

<?php foreach($plans AS $plan): ?>
                                <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch" id="plan_div_<?=$plan['id']?>">
                                    <div class="card bg-light">
                                        <div class="card-body pt-2">
                                            <div class="row">
                                                <div class="col-12 pt-3">
                                                    <h2 class="lead text-uppercase"><b><?=$plan['name']?></b></h2>
                                                    <p class="card-text"><?=$plan["tagline"]?></p>
                                                    <p class="card-text pricing pricing-monthly"><span class="font-weight-bolder text-primary text-xl"> <?=formatMoney($plan["monthly_price"])?></span> /<?=lang("Site.month")?></p>
                                                    <p class="card-text pricing pricing-quarterly d-none"><span class="font-weight-bolder text-primary text-xl"> <?=formatMoney($plan["quarterly_price"])?></span> /<?=lang("Site.quarter")?></p>
                                                    <p class="card-text pricing pricing-semi-annually d-none"><span class="font-weight-bolder text-primary text-xl"> <?=formatMoney($plan["semi_annually_price"])?></span> /<?=lang("Site.semi_annual")?></p>
                                                    <p class="card-text pricing pricing-yearly d-none"><span class="font-weight-bolder text-primary text-xl"> <?=formatMoney($plan["yearly_price"])?></span> /<?=lang("Site.year")?></p>
    <?php 
        $features = explode(";;", $plan["features"]);
        foreach ($features AS $feature):
            if(!empty($feature)):
    ?>
                                                    <p class="card-text"><?=$feature?></p>
    <?php
            endif; 
        endforeach;
    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between">
                                                <a href="#" onclick="showModal('<?=base_url().route_to('admin_route_edit_plan', $plan['id'])?>', '<?=lang('Site.edit_plan')?>')" class="btn btn-sm bg-teal" data-toggle="tooltip" title="<?=lang('Site.edit_plan')?>">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="#" id="deactivate_btn_<?=$plan['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_deactivate_plan', $plan['id']))?>', this.id, true, 'activate_btn_<?=$plan['id']?>', '', 'bg-warning')" class="btn btn-sm bg-warning" <?=$plan["status"] == "active" ? '' : 'style="display:none"' ; ?> data-toggle="tooltip" title="<?=lang("Site.deactivate_plan")?>">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                                <a href="#" id="activate_btn_<?=$plan['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_activate_plan', $plan['id']))?>', this.id, true, 'deactivate_btn_<?=$plan['id']?>', '', 'bg-olive')" class="btn btn-sm bg-olive" <?=$plan["status"] == "active" ? 'style="display:none"' : '' ; ?> data-toggle="tooltip" title="<?=lang("Site.activate_plan")?>">
                                                    <i class="fas fa-redo"></i>
                                                </a>
                                                <a href="#" id="delete_btn_<?=$plan['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_plan', $plan['id']))?>', this.id, true, 'deactivate_btn_<?=$plan['id']?>', '#plan_div_<?=$plan['id']?>', 'bg-danger')" class="btn btn-sm bg-danger" data-toggle="tooltip" title="<?=lang("Site.delete_plan")?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?=view('includes/js/modal')?>


    <script>
        function switchPricing(pricing)
        {
            $(".pricing").addClass('d-none');
            $("."+pricing).removeClass('d-none');
            $(".pricing-btn").removeClass('active');
        }
    </script>