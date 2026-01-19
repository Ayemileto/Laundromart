        
        <!-- START NAV BAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="<?=base_url()?>" class="navbar-brand">
                <img src="<?=logo()?>" height="40" alt="<?=lang('Site.logo')?>">
            </a>
        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNavigtionBar">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="headerNavigtionBar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a href="<?=base_url()?>" class="nav-link active"><?=lang('Site.home')?></a></li>
        <?php
            if(isEnabled('products_feature') && isEnabled('products_page')):
        ?>
                    <li class="nav-item"><a href="<?=fullUrl(route_to('products'))?>" class="nav-link"><?=lang('Site.products')?></a></li>
        <?php
            endif;
            
            if(isEnabled('subscription_feature') && isEnabled('subscription_plans_page')):
        ?>
                    <li class="nav-item"><a href="<?=fullUrl(route_to('plans'))?>" class="nav-link"><?=lang('Site.plans')?></a></li>
        <?php
            endif;

            if(isEnabled('contact_us_page')):
        ?>
                    <li class="nav-item"><a href="<?=fullURL(route_to('contact-us'))?>" class="nav-link"><?=lang('Site.contact_us')?></a></li>
        <?php
            endif;

            foreach(activePageMenus('top') as $topMenu):
        ?>
                    <li class="nav-item"><a href="<?=fullUrl(route_to('page', $topMenu['slug']))?>" class="nav-link"><?=$topMenu['name']?></a></li>
        <?php
            endforeach;
        ?>
                </ul>
        
        
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="<?=fullUrl(route_to('user_route_cart'))?>" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <sup style="left:-5px;"><sup class="cart-item-count badge badge-danger navbar-badge" style="font-weight:500;"><?=shoppingCartCount()?></sup></sup>
                        </a>
                    </li>
    <?php
        if(isLoggedIn() && is_numeric(userId())):
                if(isStaff()):
    ?>
                    <li class="nav-item">
                        <a href="<?=fullUrl(route_to('admin_dashboard'))?>" class="nav-link mr-1">
                            <i class="fas fa-tachometer-alt"></i> <?=lang('Site.dashboard')?>
                        </a>
                    </li>
                <?php
                    else:
                ?>
                    <li class="nav-item">
                        <a href="<?=fullUrl(route_to('user_dashboard'))?>" class="nav-link mr-1">
                            <i class="fas fa-tachometer-alt"></i> <?=lang('Site.dashboard')?>
                        </a>
                    </li>
                <?php
                    endif;
                ?>
                    <li class="nav-item">
                        <a href="<?=fullUrl(route_to('logout'))?>" class="nav-link btn btn-outline-primary">
                            <i class="fas fa-sign-out-alt"></i>
                            <?=lang('Auth.logout')?>
                        </a>
                    </li>
    <?php
        else:
    ?>
                    <li class="nav-item">
                        <a href="<?=fullUrl(route_to('login'))?>?next=<?=currentUrl()?>" class="nav-link btn btn-outline-primary text-uppercase"><?=lang('Auth.login')?></a>
                    </li>
    <?php
        endif;
    ?>
                </ul>
            </div>
        </nav>
        <!-- END NAV BAR -->
