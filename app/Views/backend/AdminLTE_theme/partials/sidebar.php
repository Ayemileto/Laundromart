<!-- Main Sidebar Container -->
<aside class="main-sidebar
    sidebar-<?=(isStaff() && strpos(currentUrl(), "admin")) ? getSetting("admin_theme_sidebar_background_color") :  getSetting("user_theme_sidebar_background_color")?>-<?=(isStaff() && strpos(currentUrl(), "admin")) ? getSetting("admin_theme_sidebar_highlight_color") : getSetting("admin_theme_sidebar_highlight_color")?>
    elevation-4"
>
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link">
        <img src="<?=logo()?>" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><?=siteName()?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=avatar()?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=userName()?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->                
        <?php
            if(isStaff() && strpos(currentUrl(), "admin")):
                //STAFF AND ADMIN SIDEBAR NAV
                echo view("backend/AdminLTE_theme/partials/sidenav/admin");
            else:
                //NORMAL USERS SIDEBAR NAV
                echo view("backend/AdminLTE_theme/partials/sidenav/user");
            endif;
        ?>
                <li class="nav-item">
                    <a href="<?=fullUrl(route_to("logout"))?>" class="nav-link">
                    <i class="fa fa-power-off nav-icon"></i>
                    <p><?=lang('Auth.logout')?></p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>