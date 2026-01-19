<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=$title?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=assetUrl("plugins/fontawesome-free/css/all.min.css")?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?=assetUrl("plugins/icheck-bootstrap/icheck-bootstrap.min.css")?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=assetUrl("backend/AdminLTE_theme/css/adminlte.min.css")?>">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- Toastr -->
        <link rel="stylesheet" href="<?=assetURL("plugins/toastr/toastr.min.css")?>">
    </head>
    <body class="hold-transition register-page">

        <?= $this->include("auth/AdminLTE_theme/partials/$view")?>

        <!-- jQuery -->
        <script src="<?=assetUrl("plugins/jquery/jquery.min.js")?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=assetUrl("plugins/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
        <!-- AdminLTE App -->
        <script src="<?=assetUrl("backend/AdminLTE_theme/js/adminlte.min.js")?>"></script>

        <script src="<?=assetUrl("plugins/toastr/toastr.min.js")?>"></script>

        <?=view("includes/js/form")?>
        <?=view('includes/js/footer')?>
    </body>
</html>