<style>
.card-header iframe {
    width: 300px!important; 
    height: 300px!important;
}
</style>
        <div class="wrapper">
            <div class="container my-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex justify-content-center pt-3 pb-5">
                        <div class="card-deck mb-3 text-center">
                            <?php
                            foreach($branches as $branch):
                            ?>
                            <div class="card mb-4 box-shadow" style="min-width: 18rem;">
                                <div class="card-header bg-primary text-white border-0">
                                    <?=$branch["google_map_location"]?>
                                </div>
                                <div class="card-body">
                                    <div class="card-text text-left">
                                        <p><?=lang('Site.office_phone')?>: <?=$branch['office_phone']?></p>
                                        <p><?=lang('Site.zipcode')?>: <?=$branch['zipcode']?></p>
                                        <p><?=lang('Site.office_address')?>: <?=$branch['office_address']?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>