        <div class="wrapper">
            <div class="container my-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-1g-6">
                        <form action="" method="post" class="bg-light p-5">
                            <h4 class="text-center pb-4"><?=lang('Site.confirm_subscription')?></h4>
                            <input type="hidden" name="plan_id" value="<?=$plan['id']?>"> 
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-12 col-md-3"> 
                                        <label for="name"><?=lang('Site.plan_name')?></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="name" class="form-control" value="<?=$plan['name']?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-12 col-md-3"> 
                                        <label for="quantity"><?=lang('Site.duration')?></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="period" class="form-control" value="<?=$period?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-12 col-md-3"> 
                                        <label for="price"><?=lang('Site.price')?></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="price" class="form-control" value="<?=formatMoney($price)?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" id="form-submit"><?=lang("Site.confirm_and_subscribe")?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>