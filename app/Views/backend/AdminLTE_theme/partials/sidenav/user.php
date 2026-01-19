                <li class="nav-item">
                    <a href="<?=fullUrl(route_to("user_dashboard"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'dashboard') ? 'active' : ''?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                        <?=lang('Site.dashboard')?>
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?=fullUrl(route_to("user_route_calendar"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'calendar') ? 'active' : ''?>">
                    <i class="fas nav-icon fa-calendar-alt"></i>
                    <p><?=lang('Site.calendar')?></p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'invoices') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <?=lang('Site.invoices')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'invoices') ? 'display: block;' : 'display: none;'?>">
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_invoices", "all"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_invoices') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.all_invoices')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_invoices", "paid"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'paid_invoices') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.paid_invoices')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_invoices", "unpaid"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'unpaid_invoices') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.unpaid_invoices')?></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'orders') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>
                            <?=lang('Site.orders')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'orders') ? 'display: block;' : 'display: none;'?>">
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_orders", "all"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.all_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_orders", "pending"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'pending_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.pending_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_orders", "active"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'active_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.active_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_orders", "completed"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'completed_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.completed_orders')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to("user_route_orders", "cancelled"))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'cancelled_orders') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.cancelled_orders')?></p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview <?=(!empty($parent_nav) && $parent_nav == 'subscriptions') ? 'menu-open' : ''?>">
                    <a href="#" class="nav-link">
                        <i class="far fa-bell nav-icon"></i>
                        <p>
                            <?=lang('Site.subscriptions')?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-3" style="<?=(!empty($parent_nav) && $parent_nav == 'subscriptions') ? 'display: block;' : 'display: none;'?>">
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_subscriptions', 'all'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_subscriptions') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.all_subscriptions')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_subscriptions', 'active'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'active_subscriptions') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.active_subscriptions')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_subscriptions', 'expiring'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'expiring_subscriptions') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.soon_to_expire')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_subscriptions', 'expired'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'expired_subscriptions') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.expired_subscriptions')?></p>
                            </a>
                        </li>
                    </ul>
                </li>

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
                            <a href="<?=fullUrl(route_to('user_route_pickups', 'all'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.all_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_pickups', 'pending'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'pending_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.pending_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_pickups', 'failed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'failed_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.failed_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_pickups', 'completed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'completed_pickups') ? 'active' : ''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=lang('Site.completed_pickups')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_deliveries', 'all'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'all_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.all_deliveries')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_deliveries', 'pending'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'pending_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.pending_deliveries')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_deliveries', 'failed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'failed_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.failed_deliveries')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=fullUrl(route_to('user_route_deliveries', 'completed'))?>" class="nav-link <?=(!empty($current_nav) && $current_nav == 'completed_deliveries') ? 'active' : ''?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=lang('Site.completed_deliveries')?></p>
                            </a>
                        </li>
                    </ul>
                </li>

