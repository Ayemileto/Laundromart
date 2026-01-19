<?php
    helper('Assets');
    helper('Site');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/solid.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0
        }

        html {
            height: 100%
        }

        p {
            color: grey
        }

        #heading {
            text-transform: uppercase;
            color: #673AB7;
            font-weight: normal
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        #msform .form-steps {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        .form-card {
            text-align: left
        }

        /* #msform fieldset:not(:first-of-type) {
            display: none
        } */

        #msform input,
        #msform textarea {
            padding: 8px 15px 8px 15px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #ECEFF1;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #673AB7;
            outline-width: 0
        }

        #msform .action-button {
            width: 200px;
            background: #673AB7;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: right
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #311B92
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px 10px 0px;
            float: right
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }

        .card {
            z-index: 0;
            border: none;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #673AB7;
            margin-bottom: 15px;
            font-weight: normal;
            text-align: left
        }

        .purple-text {
            color: #673AB7;
            font-weight: normal
        }

        .steps {
            font-size: 25px;
            color: gray;
            margin-bottom: 10px;
            font-weight: normal;
            text-align: right
        }

        .fieldlabels {
            color: gray;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #673AB7
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar #form-step-1-tab:before {
            font-family: "Font Awesome 5 Free";
            content: "\f1c0"
        }

        #progressbar #form-step-2-tab:before {
            font-family: "Font Awesome 5 Free";
            content: "\f233"
        }

        #progressbar #form-step-3-tab:before {
            font-family: "Font Awesome 5 Free"; 
	        content: "\f007";
        }

        #progressbar #form-step-4-tab:before {
            font-family: "Font Awesome 5 Free"; 
	        content: "\f055";
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #673AB7
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #673AB7
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }

        .hide {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">Set Up Your Website</h2>
                    <p>Fill all form field to go to next step</p>
                    <div id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="<?=($step >= 1)? 'active' : ''?>" id="form-step-1-tab"><strong><?=lang('Installer.database_setup')?></strong></li>
                            <li class="<?=($step >= 2)? 'active' : ''?>" id="form-step-2-tab"><strong><?=lang('Installer.website_setup')?></strong></li>
                            <li class="<?=($step >= 3)? 'active' : ''?>" id="form-step-3-tab"><strong><?=lang('Installer.superadmin_setup')?></strong></li>
                            <li class="<?=($step >= 4)? 'active' : ''?>" id="form-step-4-tab"><strong><?=lang('Installer.add_data')?></strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100" style="width:<?=$progress?>%"></div>
                        </div> <br> <!-- fieldsets -->
                        
                        <div id="step-1" class="form-steps <?=$step == 1 ? '' : 'hide'?>">
                            <form id="step-1-form" action="" method="post">
                                <input type="hidden" name="step" value="1">
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title"><?=lang('Installer.database_setup')?>:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps"><?=lang('Installer.step', [1, 4])?></h2>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.database_host')?>: *</label>
                                        <input type="text" class="form-control" name="database_host" placeholder="<?=lang('Installer.database_host')?>" value="localhost" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.database_name')?>: *</label>
                                        <input type="text" class="form-control" name="database_name" placeholder="<?=lang('Installer.database_name')?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.database_user')?>: *</label>
                                        <input type="text" class="form-control" name="database_user" placeholder="<?=lang('Installer.database_user')?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.database_password')?>: *</label>
                                        <input type="text" class="form-control" name="database_password" placeholder="<?=lang('Installer.database_password')?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.database_driver')?>: *</label>
                                        <select name="database_driver" id="" class="form-control">
                                            <option value="MySQLi" selected>MySQLi</option>
                                            <option value="Postgre">Postgre</option>
                                            <option value="SQLite3">SQLite3</option>
                                            <option value="SQLSRV">SQLSRV</option>
                                        </select>
                                    </div>
                                </div>
                                <span class="text-danger error_field" id="error"></span>
                                <button type="submit" class="mt-2 action-button" id="form-submit" onclick="submitForm('step-1-form')"><?=lang("Installer.verify_database")?></button>
                            </form>
                        </div>

                        <div id="step-2" class="form-steps <?=$step == 2 ? '' : 'hide'?>">
                            <form id="step-2-form" action="" method="post">
                                <input type="hidden" name="step" value="2">
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title"><?=lang('Installer.website_setup')?>:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps"><?=lang('Installer.step', [2, 4])?></h2>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.site_name')?>: *</label>
                                        <input type="text" class="form-control" name="site_name" placeholder="<?=lang('Installer.site_name')?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.site_title')?>: *</label>
                                        <input type="text" class="form-control" name="site_title" placeholder="<?=lang('Installer.site_title')?>" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.site_url')?>: *</label>
                                        <input type="url" class="form-control" name="site_url" placeholder="<?=lang('Installer.site_url')?>" value="" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Installer.logo')?>:</label>
                                        <input type="file" class="form-control-file" name="logo" accept="image/png,image/jpg">
                                    </div>
                                </div>
                                <span class="text-danger error_field" id="error"></span>
                                <button type="submit" class="mt-2 action-button" id="form-submit" onclick="submitForm('step-2-form')"><?=lang("Installer.setup_website")?></button>
                            </form>
                        </div>

                        <div id="step-3" class="form-steps <?=$step == 3 ? '' : 'hide'?>">
                            <form id="step-3-form" action="" method="post">
                                <input type="hidden" name="step" value="3">
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title"><?=lang('Installer.superadmin_setup')?>:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps"><?=lang('Installer.step', [3, 4])?></h2>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Auth.firstname')?>: *</label>
                                        <input type="text" class="form-control" name="firstname" placeholder="<?=lang('Auth.firstname')?>" maxlength="50" required/>
                                        <sub class="form-text text-danger error_field" id="firstname_error"></sub>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Auth.lastname')?>: *</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="<?=lang('Auth.lastname')?>" maxlength="50" required/>
                                        <sub class="form-text text-danger error_field" id="lastname_error"></sub>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Auth.username')?>: *</label>
                                        <input type="text" class="form-control" name="username" placeholder="<?=lang('Auth.username')?>" maxlength="50" required/>
                                        <sub class="form-text text-danger error_field" id="username_error"></sub>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Auth.email')?>: *</label>
                                        <input type="email" class="form-control" name="email" placeholder="<?=lang('Auth.email')?>" required/>
                                        <sub class="form-text text-danger error_field" id="email_error"></sub>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Auth.phone')?>: *</label>
                                        <input type="tel" class="form-control" name="phone" placeholder="<?=lang('Auth.phone')?>" required/>
                                        <sub class="form-text text-danger error_field" id="phone_error"></sub>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Auth.password')?>: *</label>
                                        <input type="password" class="form-control" name="password" placeholder="<?=lang('Auth.password')?>" minlength="8" required/>
                                        <sub class="form-text text-danger error_field" id="password_error"></sub>
                                    </div>
                                    <div class="form-group">
                                        <label class="fieldlabels"><?=lang('Auth.confirm_password')?>: *</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="<?=lang('Auth.confirm_password')?>" minlength="8" required/>
                                        <sub class="form-text text-danger error_field" id="confirm_password_error"></sub>
                                    </div>
                                </div>
                                <span class="text-danger error_field" id="error"></span>
                                <button type="submit" class="mt-2 action-button" id="form-submit" onclick="submitForm('step-3-form')"><?=lang("Installer.setup_superadmin")?></button>
                            </form>
                        </div>

                        <div id="step-4" class="form-steps <?=$step == 4 ? '' : 'hide'?>">
                            <form id="step-4-form" action="" method="post">
                                <input type="hidden" name="step" value="4">
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title"><?=lang('Installer.add_data')?>:</h2>
                                            <?=lang('Installer.select_data_you_will_like_to_add_to_the_system')?>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps"><?=lang('Installer.step', [4, 4])?></h2>
                                        </div>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input type="checkbox" name="users" id="" class="form-check-input" value="1">
                                        <label for="users" class="form-check-label"><?=lang('Installer.add_users_data')?></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="products" id="" class="form-check-input" value="1">
                                        <label for="products" class="form-check-label"><?=lang('Installer.add_products_data')?></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="subscription_plans" id="" class="form-check-input" value="1">
                                        <label for="subscription_plans" class="form-check-label"><?=lang('Installer.add_plans_data')?></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="pages" id="" class="form-check-input" value="1">
                                        <label for="pages" class="form-check-label"><?=lang('Installer.add_pages_data')?></label>
                                    </div>
                                </div>
                                <span class="text-danger error_field" id="error"></span>
                                <button type="submit" class="mt-2 action-button" id="form-submit" onclick="submitForm('step-4-form')"><?=lang("Installer.finish")?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function nextStep(id)
        {
            $(".form-steps").addClass('hide');
            $("#step-"+id).removeClass('hide');

            $('#form-step-'+id+'-tab').addClass('active');

            var percent = parseFloat(id/4) * 100;
            percent = percent.toFixed();
            $(".progress-bar").css("width",percent+"%");
        }
    </script>
</body>
<?=view('includes/js/form')?>
</html>