
        <!-- START FOOTER -->
        <footer>
            <div class="container-fluid bg-dark text-light">
                <div class="container">
                    <div class="row py-4">
                        <div class="col-md-4">
                            <h5>Quick Links</h5>
                            <p>
                                <ul class="list-unstyled">
                                <?php
                                    if(isEnabled('branch_locator_page')):
                                ?>
                                    <li>
                                        <a href="<?=fullURL(route_to('branch-locator'))?>"><?=lang('Site.branch_locator')?></a>
                                    </li>
                                <?php
                                    endif;
                                    if(isEnabled('contact_us_page')):
                                ?>
                                    <li>
                                        <a href="<?=fullURL(route_to('contact-us'))?>"><?=lang('Site.contact_us')?></a>
                                    </li>
                                <?php
                                    endif;
                                    
                                    foreach(activePageMenus('bottom') as $bottomMenu):
                                ?>
                                    <li>
                                        <a href="<?=fullURL(route_to('page', $bottomMenu['slug']))?>"><?=$bottomMenu['name']?></a>
                                    </li>
                                <?php
                                    endforeach;
                                ?>
                                </ul>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h5><?=lang('Site.business_hours')?></h5>
                            <p>
                                <ul class="list-unstyled">
                                    <li>
                                        <?=lang('Site.monday')?>: <?=formatTime(getSetting('open_hours_monday_from'))?> -  <?=formatTime(getSetting('open_hours_monday_to'))?> 
                                    </li>
                                    <li>
                                        <?=lang('Site.tuesday')?>: <?=formatTime(getSetting('open_hours_tuesday_from'))?> -  <?=formatTime(getSetting('open_hours_tuesday_to'))?> 
                                    </li>
                                    <li>
                                        <?=lang('Site.wednesday')?>: <?=formatTime(getSetting('open_hours_wednesday_from'))?> -  <?=formatTime(getSetting('open_hours_wednesday_to'))?> 
                                    </li>
                                    <li>
                                        <?=lang('Site.thursday')?>: <?=formatTime(getSetting('open_hours_thursday_from'))?> -  <?=formatTime(getSetting('open_hours_thursday_to'))?>  
                                    </li>
                                    <li>
                                        <?=lang('Site.friday')?>: <?=formatTime(getSetting('open_hours_friday_from'))?> -  <?=formatTime(getSetting('open_hours_friday_to'))?> 
                                    </li>
                                    <li>
                                        <?=lang('Site.saturday')?>: <?=formatTime(getSetting('open_hours_saturday_from'))?> -  <?=formatTime(getSetting('open_hours_saturday_to'))?> 
                                    </li>
                                    <li>
                                        <?=lang('Site.sunday')?>: <?=formatTime(getSetting('open_hours_sunday_from'))?> -  <?=formatTime(getSetting('open_hours_sunday_to'))?> 
                                    </li>
                                </ul>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h5>Follow Us</h5>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row copyright text-center pt-3">
                    <div class="col-12 text-light">
                        <p><?=getSetting('footer_text')?></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END FOOTER -->

    </body>

    <?=view('includes/js/footer')?>
</html>