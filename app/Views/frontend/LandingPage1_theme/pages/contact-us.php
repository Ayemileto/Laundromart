<div class="wrapper">
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> <?=lang('Site.contact_us')?>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?=fullUrl(route_to('send_contact_message'))?>" id="contact_us_form">
                            <div class="form-group">
                                <label for="name"><?=lang('Site.name')?></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="<?=lang('Site.name')?>" value="<?=isLoggedIn() ? firstName().' '.lastName(): ''?>" required>
                                <sub class="form-text text-danger error_field" id="name_error"></sub>
                            </div>
                            <div class="form-group">
                                <label for="email"><?=lang('Site.email')?></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="<?=lang('Site.email')?>" value="<?=isLoggedIn() ? userEmail(): ''?>" required>
                                <sub class="form-text text-danger error_field" id="email_error"></sub>
                            </div>
                            <div class="form-group">
                                <label for="subject"><?=lang('Site.subject')?></label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="<?=lang('Site.subject')?>" required>
                                <sub class="form-text text-danger error_field" id="subject_error"></sub>
                            </div>
                            <div class="form-group">
                                <label for="message"><?=lang('Site.message')?></label>
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="<?=lang('Site.message')?>" required></textarea>
                                <sub class="form-text text-danger error_field" id="message_error"></sub>
                            </div>
                            <div class="mx-auto">
                            <span class="text-success error_field" id="success"></span>
                            <span class="text-danger error_field" id="error"></span>   
                            <button type="submit" class="btn btn-primary text-right" id="form-submit" onclick="submitForm('contact_us_form')"><?=lang('Site.submit')?></button></div>
                        </form>
                    </div>
                </div>
            </div>
    <?php if(!empty($branches)): ?>
            <div class="col-12 col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> <?=count($branches) > 1? lang('Site.addresses') : lang('Site.address')?></div>
                    
                    <?php foreach($branches as $branch): ?>
                        <div class="card-body">
                            <p><?=lang('Site.office_address')?>: <?=$branch['office_address']?></p>
                            <p><?=lang('Site.zipcode')?>: <?=$branch['zipcode']?></p>
                            <p><?=lang('Site.office_phone')?>: <?=$branch['office_phone']?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    <?php endif; ?>
        </div>
    </div>
</div>

<?=view('includes/js/form')?>