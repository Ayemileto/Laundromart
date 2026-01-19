    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=$title?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="<?=fullUrl(route_to('admin_route_save_settings'))?>" id="update_appearance_settings">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                            <label for="name"><?=lang("Site.admin_theme")?></label>
                                        </div>
                                        <div class="col-12 col-md-9"> 
                                            <select name="admin_theme" class="form-control" required>
                                                <option value=""></option>
                                                <?php
                                                    $mail_themes_path = str_replace('\\', '/', APPPATH."Views/backend/*_theme");

                                                    $mail_themes = glob($mail_themes_path, GLOB_BRACE);

                                                    foreach($mail_themes as $theme)
                                                    {
                                                        $pathInfo = pathinfo($theme);
                                                        $filename = $pathInfo['filename'];
                                                        $filename = str_replace('_theme', '', $filename);
                                                        
                                                        $display_name = ucwords(preg_replace('/[^A-Za-z0-9]/', ' ', $filename));
                                                ?>
                                                        <option value="<?=$filename?>" <?=$settings['admin_theme'] == $filename ? 'selected' : ''?>><?=$display_name?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="admin_theme_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                            <label for="name"><?=lang("Site.admin_theme_options")?></label>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.admin_sidebar_background_color")?> 
                                            <select name="admin_theme_sidebar_background_color" class="form-control" required>
                                                <option class="bg bg-dark" value="dark" <?=$settings['admin_theme_sidebar_background_color'] == 'dark' ? 'selected' : ''?>>Dark</option>
                                                <option class="bg bg-light" value="light" <?=$settings['admin_theme_sidebar_background_color'] == 'light' ? 'selected' : ''?>>Light</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="admin_theme_sidebar_background_color_error"></sub>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.admin_sidebar_highlight_color")?> 
                                            <select name="admin_theme_sidebar_highlight_color" class="form-control" required>
                                                <option class="bg bg-primary" value="primary" <?=$settings['admin_theme_sidebar_highlight_color'] == 'primary' ? 'selected' : ''?>>Blue</option>
                                                <option class="bg bg-warning" value="warning" <?=$settings['admin_theme_sidebar_highlight_color'] == 'warning' ? 'selected' : ''?>>Yellow</option>
                                                <option class="bg bg-info" value="info" <?=$settings['admin_theme_sidebar_highlight_color'] == 'info' ? 'selected' : ''?>>Info</option>
                                                <option class="bg bg-danger" value="danger" <?=$settings['admin_theme_sidebar_highlight_color'] == 'light' ? 'selected' : ''?>>Red</option>
                                                <option class="bg bg-success" value="success" <?=$settings['admin_theme_sidebar_highlight_color'] == 'success' ? 'selected' : ''?>>Green</option>
                                                <option class="bg bg-indigo" value="indigo" <?=$settings['admin_theme_sidebar_highlight_color'] == 'indigo' ? 'selected' : ''?>>Indigo</option>
                                                <option class="bg bg-lightblue" value="lightblue" <?=$settings['admin_theme_sidebar_highlight_color'] == 'lightblue' ? 'selected' : ''?>>lightblue</option>
                                                <option class="bg bg-navy" value="navy" <?=$settings['admin_theme_sidebar_highlight_color'] == 'navy' ? 'selected' : ''?>>Navy</option>
                                                <option class="bg bg-purple" value="purple" <?=$settings['admin_theme_sidebar_highlight_color'] == 'purple' ? 'selected' : ''?>>Purple</option>
                                                <option class="bg bg-fuchsia" value="fuchsia" <?=$settings['admin_theme_sidebar_highlight_color'] == 'fuchsia' ? 'selected' : ''?>>Fuchsia</option>
                                                <option class="bg bg-pink" value="pink" <?=$settings['admin_theme_sidebar_highlight_color'] == 'pink' ? 'selected' : ''?>>Pink</option>
                                                <option class="bg bg-maroon" value="maroon" <?=$settings['admin_theme_sidebar_highlight_color'] == 'maroon' ? 'selected' : ''?>>Maroon</option>
                                                <option class="bg bg-orange" value="orange" <?=$settings['admin_theme_sidebar_highlight_color'] == 'orange' ? 'selected' : ''?>>Orange</option>
                                                <option class="bg bg-lime" value="lime" <?=$settings['admin_theme_sidebar_highlight_color'] == 'lime' ? 'selected' : ''?>>Lime</option>
                                                <option class="bg bg-teal" value="teal" <?=$settings['admin_theme_sidebar_highlight_color'] == 'teal' ? 'selected' : ''?>>Teal</option>
                                                <option class="bg bg-olive" value="olive" <?=$settings['admin_theme_sidebar_highlight_color'] == 'olive' ? 'selected' : ''?>>Olive</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="admin_theme_sidebar_highlight_color_error"></sub>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.admin_theme_accent_color")?> 
                                            <select name="admin_theme_accent_color" class="form-control" required>
                                                <option class="bg bg-primary" value="primary" <?=$settings['admin_theme_accent_color'] == 'primary' ? 'selected' : ''?>>Blue</option>
                                                <option class="bg bg-warning" value="warning" <?=$settings['admin_theme_accent_color'] == 'warning' ? 'selected' : ''?>>Yellow</option>
                                                <option class="bg bg-info" value="info" <?=$settings['admin_theme_accent_color'] == 'info' ? 'selected' : ''?>>Info</option>
                                                <option class="bg bg-danger" value="danger" <?=$settings['admin_theme_accent_color'] == 'light' ? 'selected' : ''?>>Red</option>
                                                <option class="bg bg-success" value="success" <?=$settings['admin_theme_accent_color'] == 'success' ? 'selected' : ''?>>Green</option>
                                                <option class="bg bg-indigo" value="indigo" <?=$settings['admin_theme_accent_color'] == 'indigo' ? 'selected' : ''?>>Indigo</option>
                                                <option class="bg bg-lightblue" value="lightblue" <?=$settings['admin_theme_accent_color'] == 'lightblue' ? 'selected' : ''?>>lightblue</option>
                                                <option class="bg bg-navy" value="navy" <?=$settings['admin_theme_accent_color'] == 'navy' ? 'selected' : ''?>>Navy</option>
                                                <option class="bg bg-purple" value="purple" <?=$settings['admin_theme_accent_color'] == 'purple' ? 'selected' : ''?>>Purple</option>
                                                <option class="bg bg-fuchsia" value="fuchsia" <?=$settings['admin_theme_accent_color'] == 'fuchsia' ? 'selected' : ''?>>Fuchsia</option>
                                                <option class="bg bg-pink" value="pink" <?=$settings['admin_theme_accent_color'] == 'pink' ? 'selected' : ''?>>Pink</option>
                                                <option class="bg bg-maroon" value="maroon" <?=$settings['admin_theme_accent_color'] == 'maroon' ? 'selected' : ''?>>Maroon</option>
                                                <option class="bg bg-orange" value="orange" <?=$settings['admin_theme_accent_color'] == 'orange' ? 'selected' : ''?>>Orange</option>
                                                <option class="bg bg-lime" value="lime" <?=$settings['admin_theme_accent_color'] == 'lime' ? 'selected' : ''?>>Lime</option>
                                                <option class="bg bg-teal" value="teal" <?=$settings['admin_theme_accent_color'] == 'teal' ? 'selected' : ''?>>Teal</option>
                                                <option class="bg bg-olive" value="olive" <?=$settings['admin_theme_accent_color'] == 'olive' ? 'selected' : ''?>>Olive</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="admin_theme_accent_color_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.admin_navbar_background_color")?> 
                                            <select name="admin_theme_navbar_background_color" class="form-control" required>
                                                <option class="bg bg-primary" value="primary" <?=$settings['admin_theme_navbar_background_color'] == 'primary' ? 'selected' : ''?>>Blue</option>
                                                <option class="bg bg-info" value="info" <?=$settings['admin_theme_navbar_background_color'] == 'info' ? 'selected' : ''?>>Info</option>
                                                <option class="bg bg-secondary" value="secondary" <?=$settings['admin_theme_navbar_background_color'] == 'secondary' ? 'selected' : ''?>>Secondary</option>
                                                <option class="bg bg-success" value="success" <?=$settings['admin_theme_navbar_background_color'] == 'success' ? 'selected' : ''?>>Green</option>
                                                <option class="bg bg-danger" value="danger" <?=$settings['admin_theme_navbar_background_color'] == 'danger' ? 'selected' : ''?>>Red</option>
                                                <option class="bg bg-indigo" value="indigo" <?=$settings['admin_theme_navbar_background_color'] == 'indigo' ? 'selected' : ''?>>Indigo</option>
                                                <option class="bg bg-purple" value="purple" <?=$settings['admin_theme_navbar_background_color'] == 'purple' ? 'selected' : ''?>>Purple</option>
                                                <option class="bg bg-pink" value="pink" <?=$settings['admin_theme_navbar_background_color'] == 'pink' ? 'selected' : ''?>>Pink</option>
                                                <option class="bg bg-navy" value="navy" <?=$settings['admin_theme_navbar_background_color'] == 'navy' ? 'selected' : ''?>>Navy</option>
                                                <option class="bg bg-lightblue" value="lightblue" <?=$settings['admin_theme_navbar_background_color'] == 'lightblue' ? 'selected' : ''?>>lightblue</option>
                                                <option class="bg bg-teal" value="teal" <?=$settings['admin_theme_navbar_background_color'] == 'teal' ? 'selected' : ''?>>Teal</option>
                                                <option class="bg bg-cyan" value="cyan" <?=$settings['admin_theme_navbar_background_color'] == 'cyan' ? 'selected' : ''?>>Cyan</option>
                                                <option class="bg bg-dark" value="dark" <?=$settings['admin_theme_navbar_background_color'] == 'dark' ? 'selected' : ''?>>Dark</option>
                                                <option class="bg bg-gray-dark" value="gray-dark" <?=$settings['admin_theme_navbar_background_color'] == 'gray-dark' ? 'selected' : ''?>>Gray Dark</option>
                                                <option class="bg bg-gray" value="gray" <?=$settings['admin_theme_navbar_background_color'] == 'gray' ? 'selected' : ''?>>Gray</option>
                                                <option class="bg bg-light" value="light" <?=$settings['admin_theme_navbar_background_color'] == 'light' ? 'selected' : ''?>>Light</option>
                                                <option class="bg bg-warning" value="warning" <?=$settings['admin_theme_navbar_background_color'] == 'warning' ? 'selected' : ''?>>Yellow</option>
                                                <option class="bg bg-white" value="white" <?=$settings['admin_theme_navbar_background_color'] == 'white' ? 'selected' : ''?>>White</option>
                                                <option class="bg bg-orange" value="orange" <?=$settings['admin_theme_navbar_background_color'] == 'orange' ? 'selected' : ''?>>Orange</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="admin_theme_navbar_background_color_error"></sub>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.admin_navbar_text_color")?> 
                                            <select name="admin_theme_navbar_text_color" class="form-control" required>
                                                <option class="bg bg-dark" value="light" <?=$settings['admin_theme_navbar_text_color'] == 'light' ? 'selected' : ''?>>Dark</option>
                                                <option class="bg bg-light" value="dark" <?=$settings['admin_theme_navbar_text_color'] == 'dark' ? 'selected' : ''?>>Light</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="admin_theme_navbar_text_color_error"></sub>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4"></div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                            <label for="name"><?=lang("Site.user_theme")?></label>
                                        </div>
                                        <div class="col-12 col-md-9"> 
                                            <select name="user_theme" class="form-control" required>
                                                <option value=""></option>
                                                <?php
                                                    $mail_themes_path = str_replace('\\', '/', APPPATH."Views/backend/*_theme");

                                                    $mail_themes = glob($mail_themes_path, GLOB_BRACE);

                                                    foreach($mail_themes as $theme)
                                                    {
                                                        $pathInfo = pathinfo($theme);
                                                        $filename = $pathInfo['filename'];
                                                        $filename = str_replace('_theme', '', $filename);
                                                        
                                                        $display_name = ucwords(preg_replace('/[^A-Za-z0-9]/', ' ', $filename));
                                                ?>
                                                        <option value="<?=$filename?>" <?=$settings['user_theme'] == $filename ? 'selected' : ''?>><?=$display_name?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="user_theme_error"></sub>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                            <label for="name"><?=lang("Site.user_theme_options")?></label>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.user_sidebar_background_color")?> 
                                            <select name="user_theme_sidebar_background_color" class="form-control" required>
                                                <option class="bg bg-dark" value="dark" <?=$settings['user_theme_sidebar_background_color'] == 'dark' ? 'selected' : ''?>>Dark</option>
                                                <option class="bg bg-light" value="light" <?=$settings['user_theme_sidebar_background_color'] == 'light' ? 'selected' : ''?>>Light</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="user_theme_sidebar_background_color_error"></sub>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.user_sidebar_highlight_color")?> 
                                            <select name="user_theme_sidebar_highlight_color" class="form-control" required>
                                                <option class="bg bg-primary" value="primary" <?=$settings['user_theme_sidebar_highlight_color'] == 'primary' ? 'selected' : ''?>>Blue</option>
                                                <option class="bg bg-warning" value="warning" <?=$settings['user_theme_sidebar_highlight_color'] == 'warning' ? 'selected' : ''?>>Yellow</option>
                                                <option class="bg bg-info" value="info" <?=$settings['user_theme_sidebar_highlight_color'] == 'info' ? 'selected' : ''?>>Info</option>
                                                <option class="bg bg-danger" value="danger" <?=$settings['user_theme_sidebar_highlight_color'] == 'light' ? 'selected' : ''?>>Red</option>
                                                <option class="bg bg-success" value="success" <?=$settings['user_theme_sidebar_highlight_color'] == 'success' ? 'selected' : ''?>>Green</option>
                                                <option class="bg bg-indigo" value="indigo" <?=$settings['user_theme_sidebar_highlight_color'] == 'indigo' ? 'selected' : ''?>>Indigo</option>
                                                <option class="bg bg-lightblue" value="lightblue" <?=$settings['user_theme_sidebar_highlight_color'] == 'lightblue' ? 'selected' : ''?>>lightblue</option>
                                                <option class="bg bg-navy" value="navy" <?=$settings['user_theme_sidebar_highlight_color'] == 'navy' ? 'selected' : ''?>>Navy</option>
                                                <option class="bg bg-purple" value="purple" <?=$settings['user_theme_sidebar_highlight_color'] == 'purple' ? 'selected' : ''?>>Purple</option>
                                                <option class="bg bg-fuchsia" value="fuchsia" <?=$settings['user_theme_sidebar_highlight_color'] == 'fuchsia' ? 'selected' : ''?>>Fuchsia</option>
                                                <option class="bg bg-pink" value="pink" <?=$settings['user_theme_sidebar_highlight_color'] == 'pink' ? 'selected' : ''?>>Pink</option>
                                                <option class="bg bg-maroon" value="maroon" <?=$settings['user_theme_sidebar_highlight_color'] == 'maroon' ? 'selected' : ''?>>Maroon</option>
                                                <option class="bg bg-orange" value="orange" <?=$settings['user_theme_sidebar_highlight_color'] == 'orange' ? 'selected' : ''?>>Orange</option>
                                                <option class="bg bg-lime" value="lime" <?=$settings['user_theme_sidebar_highlight_color'] == 'lime' ? 'selected' : ''?>>Lime</option>
                                                <option class="bg bg-teal" value="teal" <?=$settings['user_theme_sidebar_highlight_color'] == 'teal' ? 'selected' : ''?>>Teal</option>
                                                <option class="bg bg-olive" value="olive" <?=$settings['user_theme_sidebar_highlight_color'] == 'olive' ? 'selected' : ''?>>Olive</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="user_theme_sidebar_highlight_color_error"></sub>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.user_theme_accent_color")?> 
                                            <select name="user_theme_accent_color" class="form-control" required>
                                                <option class="bg bg-primary" value="primary" <?=$settings['user_theme_accent_color'] == 'primary' ? 'selected' : ''?>>Blue</option>
                                                <option class="bg bg-warning" value="warning" <?=$settings['user_theme_accent_color'] == 'warning' ? 'selected' : ''?>>Yellow</option>
                                                <option class="bg bg-info" value="info" <?=$settings['user_theme_accent_color'] == 'info' ? 'selected' : ''?>>Info</option>
                                                <option class="bg bg-danger" value="danger" <?=$settings['user_theme_accent_color'] == 'light' ? 'selected' : ''?>>Red</option>
                                                <option class="bg bg-success" value="success" <?=$settings['user_theme_accent_color'] == 'success' ? 'selected' : ''?>>Green</option>
                                                <option class="bg bg-indigo" value="indigo" <?=$settings['user_theme_accent_color'] == 'indigo' ? 'selected' : ''?>>Indigo</option>
                                                <option class="bg bg-lightblue" value="lightblue" <?=$settings['user_theme_accent_color'] == 'lightblue' ? 'selected' : ''?>>lightblue</option>
                                                <option class="bg bg-navy" value="navy" <?=$settings['user_theme_accent_color'] == 'navy' ? 'selected' : ''?>>Navy</option>
                                                <option class="bg bg-purple" value="purple" <?=$settings['user_theme_accent_color'] == 'purple' ? 'selected' : ''?>>Purple</option>
                                                <option class="bg bg-fuchsia" value="fuchsia" <?=$settings['user_theme_accent_color'] == 'fuchsia' ? 'selected' : ''?>>Fuchsia</option>
                                                <option class="bg bg-pink" value="pink" <?=$settings['user_theme_accent_color'] == 'pink' ? 'selected' : ''?>>Pink</option>
                                                <option class="bg bg-maroon" value="maroon" <?=$settings['user_theme_accent_color'] == 'maroon' ? 'selected' : ''?>>Maroon</option>
                                                <option class="bg bg-orange" value="orange" <?=$settings['user_theme_accent_color'] == 'orange' ? 'selected' : ''?>>Orange</option>
                                                <option class="bg bg-lime" value="lime" <?=$settings['user_theme_accent_color'] == 'lime' ? 'selected' : ''?>>Lime</option>
                                                <option class="bg bg-teal" value="teal" <?=$settings['user_theme_accent_color'] == 'teal' ? 'selected' : ''?>>Teal</option>
                                                <option class="bg bg-olive" value="olive" <?=$settings['user_theme_accent_color'] == 'olive' ? 'selected' : ''?>>Olive</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="user_theme_accent_color_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.user_navbar_background_color")?> 
                                            <select name="user_theme_navbar_background_color" class="form-control" required>
                                                <option class="bg bg-primary" value="primary" <?=$settings['user_theme_navbar_background_color'] == 'primary' ? 'selected' : ''?>>Blue</option>
                                                <option class="bg bg-info" value="info" <?=$settings['user_theme_navbar_background_color'] == 'info' ? 'selected' : ''?>>Info</option>
                                                <option class="bg bg-secondary" value="secondary" <?=$settings['user_theme_navbar_background_color'] == 'secondary' ? 'selected' : ''?>>Secondary</option>
                                                <option class="bg bg-success" value="success" <?=$settings['user_theme_navbar_background_color'] == 'success' ? 'selected' : ''?>>Green</option>
                                                <option class="bg bg-danger" value="danger" <?=$settings['user_theme_navbar_background_color'] == 'danger' ? 'selected' : ''?>>Red</option>
                                                <option class="bg bg-indigo" value="indigo" <?=$settings['user_theme_navbar_background_color'] == 'indigo' ? 'selected' : ''?>>Indigo</option>
                                                <option class="bg bg-purple" value="purple" <?=$settings['user_theme_navbar_background_color'] == 'purple' ? 'selected' : ''?>>Purple</option>
                                                <option class="bg bg-pink" value="pink" <?=$settings['user_theme_navbar_background_color'] == 'pink' ? 'selected' : ''?>>Pink</option>
                                                <option class="bg bg-navy" value="navy" <?=$settings['user_theme_navbar_background_color'] == 'navy' ? 'selected' : ''?>>Navy</option>
                                                <option class="bg bg-lightblue" value="lightblue" <?=$settings['user_theme_navbar_background_color'] == 'lightblue' ? 'selected' : ''?>>lightblue</option>
                                                <option class="bg bg-teal" value="teal" <?=$settings['user_theme_navbar_background_color'] == 'teal' ? 'selected' : ''?>>Teal</option>
                                                <option class="bg bg-cyan" value="cyan" <?=$settings['user_theme_navbar_background_color'] == 'cyan' ? 'selected' : ''?>>Cyan</option>
                                                <option class="bg bg-dark" value="dark" <?=$settings['user_theme_navbar_background_color'] == 'dark' ? 'selected' : ''?>>Dark</option>
                                                <option class="bg bg-gray-dark" value="gray-dark" <?=$settings['user_theme_navbar_background_color'] == 'gray-dark' ? 'selected' : ''?>>Gray Dark</option>
                                                <option class="bg bg-gray" value="gray" <?=$settings['user_theme_navbar_background_color'] == 'gray' ? 'selected' : ''?>>Gray</option>
                                                <option class="bg bg-light" value="light" <?=$settings['user_theme_navbar_background_color'] == 'light' ? 'selected' : ''?>>Light</option>
                                                <option class="bg bg-warning" value="warning" <?=$settings['user_theme_navbar_background_color'] == 'warning' ? 'selected' : ''?>>Yellow</option>
                                                <option class="bg bg-white" value="white" <?=$settings['user_theme_navbar_background_color'] == 'white' ? 'selected' : ''?>>White</option>
                                                <option class="bg bg-orange" value="orange" <?=$settings['user_theme_navbar_background_color'] == 'orange' ? 'selected' : ''?>>Orange</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="user_theme_navbar_background_color_error"></sub>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?=lang("Site.user_navbar_text_color")?> 
                                            <select name="user_theme_navbar_text_color" class="form-control" required>
                                                <option class="bg bg-dark" value="light" <?=$settings['user_theme_navbar_text_color'] == 'light' ? 'selected' : ''?>>Dark</option>
                                                <option class="bg bg-light" value="dark" <?=$settings['user_theme_navbar_text_color'] == 'dark' ? 'selected' : ''?>>Light</option>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="user_theme_navbar_text_color_error"></sub>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-4"></div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                            <label for="name"><?=lang("Site.auth_theme")?></label>
                                        </div>
                                        <div class="col-12 col-md-9"> 
                                            <select name="auth_theme" class="form-control" required>
                                                <option value=""></option>
                                                <?php
                                                    $mail_themes_path = str_replace('\\', '/', APPPATH."Views/auth/*_theme");

                                                    $mail_themes = glob($mail_themes_path, GLOB_BRACE);

                                                    foreach($mail_themes as $theme)
                                                    {
                                                        $pathInfo = pathinfo($theme);
                                                        $filename = $pathInfo['filename'];
                                                        $filename = str_replace('_theme', '', $filename);
                                                        
                                                        $display_name = ucwords(preg_replace('/[^A-Za-z0-9]/', ' ', $filename));
                                                ?>
                                                        <option value="<?=$filename?>" <?=$settings['auth_theme'] == $filename ? 'selected' : ''?>><?=$display_name?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="auth_theme_error"></sub>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-5"></div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-3"> 
                                            <label for="name"><?=lang("Site.front_theme")?></label>
                                        </div>
                                        <div class="col-12 col-md-9"> 
                                            <select name="front_theme" class="form-control" required>
                                                <option value=""></option>
                                                <?php
                                                    $mail_themes_path = str_replace('\\', '/', APPPATH."Views/frontend/*_theme");

                                                    $mail_themes = glob($mail_themes_path, GLOB_BRACE);

                                                    foreach($mail_themes as $theme)
                                                    {
                                                        $pathInfo = pathinfo($theme);
                                                        $filename = $pathInfo['filename'];
                                                        $filename = str_replace('_theme', '', $filename);
                                                        
                                                        $display_name = ucwords(preg_replace('/[^A-Za-z0-9]/', ' ', $filename));
                                                ?>
                                                        <option value="<?=$filename?>" <?=$settings['front_theme'] == $filename ? 'selected' : ''?>><?=$display_name?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <sub class="form-text error_field text-danger" id="front_theme_error"></sub>
                                        </div>
                                    </div>
                                </div>

                                <span class="text-success error_field" id="success"></span>
                                <span class="text-danger error_field" id="error"></span>

                                <div class="">
                                    <button type="submit" class="btn btn-primary mt-2 float-right" id="form-submit" onclick="submitForm('update_appearance_settings')"><?=lang("Site.save")?></button>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>