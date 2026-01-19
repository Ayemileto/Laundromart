        <!-- START WRAPPER -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                <?php
                    if($status == 'success'):
                ?>
                    <div class="col-12 text-center text-success" style="padding-top:150px;padding-bottom:120px;">
                        <h1><?=lang('Site.success')?></h1>
                        <p class="lead"><?=lang('Site.your_payment_was_successful')?></p>
                    </div>
                <?php
                    elseif($status == 'processing'):
                ?>
                    <div class="col-12 text-center text-success" style="padding-top:150px;padding-bottom:120px;">
                        <h1><?=lang('Site.processing')?></h1>
                        <p class="lead"><?=lang('Site.your_payment_is_being_processed')?></p>
                    </div>
                <?php
                    elseif($status == 'cancelled'):
                ?>
                    <div class="col-12 text-center text-danger" style="padding-top:150px;padding-bottom:120px;">
                        <h1><?=lang('Site.cancelled')?></h1>
                        <p class="lead"><?=lang('Site.payment_cancelled')?></p>
                    </div>
                <?php
                    elseif($status == 'failed'):
                ?>
                    <div class="col-12 text-center text-danger" style="padding-top:150px;padding-bottom:120px;">
                        <h1><?=lang('Site.failed')?></h1>
                        <p class="lead"><?=lang('Site.your_payment_was_not_successful')?></p>
                    </div>
                <?php
                    elseif($status == 'cash'):
                ?>
                    <div class="col-12 text-center text-primary" style="padding-top:150px;padding-bottom:120px;">
                        <h1><?=lang('Site.cash_payment_title')?></h1>
                        <p class="lead"><?=lang('Site.cash_payment_message')?></p>
                    </div>
                <?php
                    else:
                ?>
                    <div class="col-12 text-center text-warning" style="padding-top:150px;padding-bottom:120px;">
                        <h1><?=lang('Site.payment_status_unknown')?></h1>
                        <p class="lead"><?=lang('Site.your_payment_status_is_unknown')?></p>
                    </div>
                <?php
                    endif;
                ?>
                </div>
            </div>

        </div>