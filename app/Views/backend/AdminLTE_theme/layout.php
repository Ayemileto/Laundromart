<?php
    echo $this->include("backend/AdminLTE_theme/partials/header");
    echo $this->include("backend/AdminLTE_theme/partials/sidebar");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?=$title?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>"><?=lang("Site.home")?></a></li>
                        <li class="breadcrumb-item active"><?=$title?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php
    echo $this->include("backend/AdminLTE_theme/$view");
?>

</div>
<!-- /.content-wrapper -->

<?php
    echo $this->include("backend/AdminLTE_theme/partials/footer");