<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="<?=$meta_description ?? getSetting('site_description')?>">

        <title><?=siteName()?> - <?=$title ?? ucwords(lang('dashboard'))?></title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?=assetUrl("plugins/fontawesome-free/css/all.min.css")?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=assetUrl("backend/AdminLTE_theme/css/adminlte.min.css")?>">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        
        <!-- jQuery -->
        <script src="<?=assetUrl("plugins/jquery/jquery.min.js")?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=assetUrl("plugins/bootstrap/js/bootstrap.bundle.min.js")?>"></script>

        <?=view('includes/css/header')?>
        
    </head>
    <body class="hold-transition sidebar-mini accent-<?=isStaff() && strpos(currentUrl(), "admin") ? getSetting("admin_theme_accent_color") : getSetting("user_theme_accent_color")?>">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand 
                navbar-<?=isStaff() && strpos(currentUrl(), "admin") ? getSetting("admin_theme_navbar_text_color") : getSetting("user_theme_navbar_text_color")?> 
                navbar-<?=isStaff() && strpos(currentUrl(), "admin") ? getSetting("admin_theme_navbar_background_color") : getSetting("user_theme_navbar_background_color")?>">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=base_url().route_to("home")?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=fullUrl(route_to('contact-us'))?>" class="nav-link"><?=lang('Site.contact_us')?></a>
                </li>
                <?php 
                    if(isStaff()):
                        if(strpos(currentUrl(), "admin")):    
                ?>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?=fullUrl(route_to('user_dashboard'))?>" class="nav-link"><?=lang('Site.user_dashboard')?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?=fullUrl(route_to('admin_dashboard'))?>" class="nav-link"><?=lang('Site.admin_dashboard')?></a>
                    </li>
                <?php endif; endif;?>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=fullUrl(route_to('user_route_cart'))?>">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-danger navbar-badge cart-item-count"><?=shoppingCartCount()?></span>
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?=fullUrl(route_to("logout"))?>" class="nav-link"><?=lang('Auth.logout')?></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->