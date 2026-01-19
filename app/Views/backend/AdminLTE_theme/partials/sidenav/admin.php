                <li class="nav-item">
                    <a href="<?=fullUrl(route_to("admin_dashboard"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'dashboard') ? 'active' : ''?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                        <?=lang('Site.dashboard')?>
                        </p>
                    </a>
                </li>
            <?php
                if(has_permission('view_calendar')):
            ?>
                <li class="nav-item">
                    <a href="<?=fullUrl(route_to("admin_route_calendar"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'calendar') ? 'active' : ''?>">
                    <i class="fas nav-icon fa-calendar-alt"></i>
                    <p><?=lang('Site.calendar')?></p>
                    </a>
                </li>
            <?php
                endif;
                
                if(has_permission('view_statistic')):
            ?>
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'analytics') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <?=lang('Site.analytics')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'analytics') ? 'display: block;' : 'display: none;'?>">
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_analytics", "sales"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'sales') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.sales')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_analytics", "visitors"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'visitors') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.visitors')?></p>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php
                endif;
                
                if(has_permission('view_invoice') || has_permission('add_invoice')):
            ?>
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'invoices') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <?=lang('Site.invoices')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'invoices') ? 'display: block;' : 'display: none;'?>">
                <?php
                    if(has_permission('add_invoice')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_create_invoice"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'create_invoice') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.create_invoice')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                    if(has_permission('view_invoice')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_invoices", "all"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_invoices') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.all_invoices')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_invoices", "paid"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'paid_invoices') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.paid_invoices')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_invoices", "unpaid"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'unpaid_invoices') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.unpaid_invoices')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                ?>
                    </ul>
                </li>
            <?php
                endif;
                
                if(has_permission('view_product') || has_permission('view_product_service')):
            ?>
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'products') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            <?=lang('Site.products')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'products') ? 'display: block;' : 'display: none;'?>">
                <?php
                    if(has_permission('view_product')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_list_product"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_products') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.all_products')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                    if(has_permission('view_product_service')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_list_product_services"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'product_services') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.product_services')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                ?>
                    </ul>
                </li>
            <?php
                endif;
                
                if(has_permission('view_order') || has_permission('add_order')):
            ?>
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'orders') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>
                            <?=lang('Site.orders')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'orders') ? 'display: block;' : 'display: none;'?>">
                <?php
                    if(has_permission('add_order')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_create_order"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'create_order') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.create_order')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                    if(has_permission('view_order')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_orders", "all"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.all_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_orders", "pending"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'pending_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.pending_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_orders", "active"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'active_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.active_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_orders", "completed"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'completed_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.completed_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_orders", "cancelled"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'cancelled_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.cancelled_orders')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                ?>
                    </ul>
                </li>
            <?php
                endif;
                
                if(has_permission('view_plan')):
            ?>
                <li class="nav-item">
                    <a href="<?=fullUrl(route_to("admin_route_list_plan"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'subscription_plans') ? 'active' : ''?>">
                        <i class="fas nav-icon fa-th"></i>
                        <p><?=lang('Site.subscription_plans')?></p>
                    </a>
                </li>
            <?php
                endif;
                
                if(has_permission('view_subscription')):
            ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-bell nav-icon"></i>
                        <p>
                            <?=lang('Site.subscriptions')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'subscriptions') ? 'display: block;' : 'display: none;'?>">
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'all'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_subscriptions') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.all_subscriptions')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'active'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'active_subscriptions') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.active_subscriptions')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'expiring'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'expiring_subscriptions') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.soon_to_expire')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_subscriptions', 'expired'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'expired_subscriptions') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.expired_subscriptions')?></p>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php
                endif;
                if(has_permission('view_shipping')):
            ?>  
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-bell nav-icon"></i>
                        <p>
                            <?=lang('Site.shippings')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'shippings') ? 'display: block;' : 'display: none;'?>">
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_pickups', 'all'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.all_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_pickups', 'pending'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'pending_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.pending_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_pickups', 'failed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'failed_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.failed_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_pickups', 'completed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'completed_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.completed_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_deliveries', 'all'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.all_deliveries')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_deliveries', 'pending'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'pending_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.pending_deliveries')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_deliveries', 'failed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'failed_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.failed_deliveries')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_deliveries', 'completed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'completed_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.completed_deliveries')?></p>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php
                endif;
                if(has_permission('view_user')):
            ?>

                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'users') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="far fa-user nav-icon"></i>
                        <p>
                            <?=lang('Site.users')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'users') ? 'display: block;' : 'display: none;'?>">
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_users", "all"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_users') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.all_users')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_users", "active"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'active_users') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.active_users')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_users", "inactive"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'inactive_users') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.inactive_users')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_users", "email_not_verified"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'email_not_verified_users') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.email_not_verified_users')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_users", "banned"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'banned_users') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.banned_users')?></p>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php
                endif;

                if(has_permission('view_staff') || has_permission('view_roles')):
            ?>
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'staffs') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users nav-icon"></i>
                        <p>
                            <?=lang('Site.staffs')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'staffs') ? 'display: block;' : 'display: none;'?>">
            <?php
                    if(has_permission('view_staff')):
            ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_list_staff"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'staff_list') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.staff_list')?></p>
                            </a>
                        </li>
            <?php
                    endif;
                    if(has_permission('view_roles')):
            ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_role_list"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'roles_and_permission') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.roles_and_permission')?></p>
                            </a>
                        </li>
            <?php
                    endif;
            ?>
                    </ul>
                </li>
            <?php
                endif;

                if(has_permission('view_page')):
            ?>
                <li class="nav-item">
                    <a href="<?=fullUrl(route_to("admin_route_pages"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'pages') ? 'active' : ''?>">
                        <i class="fas nav-icon fa-th"></i>
                        <p><?=lang('Site.manage_pages')?></p>
                    </a>
                </li>
            <?php
                endif;

                if(has_permission('view_setting') || has_permission('update_setting') || has_permission('view_location')
                    || has_permission('update_payment_setting' || has_permission('add_branch') || has_permission('update_branch'))
                ):
            ?>

                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'settings') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            <?=lang('Site.settings')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'settings') ? 'display: block;' : 'display: none;'?>">
                <?php
                    if(has_permission('update_setting')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_settings", 'site'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'site_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.site_settings')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_settings", 'appearance'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'appearance_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.appearance_settings')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                    if(has_permission('view_location') || has_permission('add_branch') || has_permission('update_branch')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_location_settings'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'location_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.location_settings')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                    if(has_permission('update_setting')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_settings", 'mail'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'mail_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.mail_settings')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_settings", 'page'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'page_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.page_settings')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                    if(has_permission('update_payment_setting')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('admin_route_payment_settings'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'payment_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.payment_settings')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                    if(has_permission('update_setting')):
                ?>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_settings", 'seo'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'seo_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.seo_settings')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("admin_route_settings", 'working_hours'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'working_hours_settings') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.working_hours_settings')?></p>
                            </a>
                        </li>
                <?php
                    endif;
                ?>
                    </ul>
                </li>
            <?php
                endif;
            ?>