    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#openHoursSettings" data-toggle="tab"><?=lang("Site.open_hours_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#pickupHoursSettings" data-toggle="tab"><?=lang("Site.pickup_hours_settings")?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#deliveryHoursSettings" data-toggle="tab"><?=lang("Site.delivery_hours_settings")?></a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="openHoursSettings">
                                    <form action="<?=fullUrl(route_to('admin_route_save_settings'))?>" method="post" class="form-horizontal" id="openHoursSettingsForm">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-5 text-center">
                                                <?=lang("Site.office_opens")?>
                                            </div>
                                            <div class="col-sm-5 text-center">
                                                <?=lang("Site.office_closes")?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="open_hours_monday_from" class="col-sm-3 col-form-label"><?=lang("Site.open_hours_monday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="open_hours_monday_from" name="open_hours_monday_from" value="<?=$settings["open_hours_monday_from"]?>">
                                                <sub class="error_field text-danger" id="open_hours_monday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="open_hours_monday_to" name="open_hours_monday_to" value="<?=$settings["open_hours_monday_to"]?>">
                                                <sub class="error_field text-danger" id="open_hours_monday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="open_hours_tuesday_from" class="col-sm-3 col-form-label"><?=lang("Site.open_hours_tuesday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="open_hours_tuesday_from" name="open_hours_tuesday_from" value="<?=$settings["open_hours_tuesday_from"]?>">
                                                <sub class="error_field text-danger" id="open_hours_tuesday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="open_hours_tuesday_to" name="open_hours_tuesday_to" value="<?=$settings["open_hours_tuesday_to"]?>">
                                                <sub class="error_field text-danger" id="open_hours_tuesday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="open_hours_wednesday_from" class="col-sm-3 col-form-label"><?=lang("Site.open_hours_wednesday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="open_hours_wednesday_from" name="open_hours_wednesday_from" value="<?=$settings["open_hours_wednesday_from"]?>">
                                                <sub class="error_field text-danger" id="open_hours_wednesday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="open_hours_wednesday_to" name="open_hours_wednesday_to" value="<?=$settings["open_hours_wednesday_to"]?>">
                                                <sub class="error_field text-danger" id="open_hours_wednesday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="open_hours_thursday_from" class="col-sm-3 col-form-label"><?=lang("Site.open_hours_thursday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="open_hours_thursday_from" name="open_hours_thursday_from" value="<?=$settings["open_hours_thursday_from"]?>">
                                                <sub class="error_field text-danger" id="open_hours_thursday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="open_hours_thursday_to" name="open_hours_thursday_to" value="<?=$settings["open_hours_thursday_to"]?>">
                                                <sub class="error_field text-danger" id="open_hours_thursday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="open_hours_friday_from" class="col-sm-3 col-form-label"><?=lang("Site.open_hours_friday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="open_hours_friday_from" name="open_hours_friday_from" value="<?=$settings["open_hours_friday_from"]?>">
                                                <sub class="error_field text-danger" id="open_hours_friday_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="open_hours_friday_to" name="open_hours_friday_to" value="<?=$settings["open_hours_friday_to"]?>">
                                                <sub class="error_field text-danger" id="open_hours_friday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="open_hours_saturday_from" class="col-sm-3 col-form-label"><?=lang("Site.open_hours_saturday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="open_hours_saturday_from" name="open_hours_saturday_from" value="<?=$settings["open_hours_saturday_from"]?>">
                                                <sub class="error_field text-danger" id="open_hours_saturday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="open_hours_saturday_to" name="open_hours_saturday_to" value="<?=$settings["open_hours_saturday_to"]?>">
                                                <sub class="error_field text-danger" id="open_hours_saturday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="open_hours_sunday_from" class="col-sm-3 col-form-label"><?=lang("Site.open_hours_sunday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="open_hours_sunday_from" name="open_hours_sunday_from" value="<?=$settings["open_hours_sunday_from"]?>">
                                                <sub class="error_field text-danger" id="open_hours_sunday_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="open_hours_sunday_to" name="open_hours_sunday_to" value="<?=$settings["open_hours_sunday_to"]?>">
                                                <sub class="error_field text-danger" id="open_hours_sunday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="col-12 text-danger error_field" id="error_error"></span>
                                            <span class="col-12 text-success error_field" id="success"></span>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary float-right" onclick="submitForm('openHoursSettingsForm')">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="pickupHoursSettings">
                                    <form action="<?=fullUrl(route_to('admin_route_save_settings'))?>" method="post" class="form-horizontal" id="pickupHoursSettingsForm">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-5 text-center">
                                                <?=lang("Site.pickup_starts")?>
                                            </div>
                                            <div class="col-sm-5 text-center">
                                                <?=lang("Site.pickup_ends")?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pickup_hours_monday_from" class="col-sm-3 col-form-label"><?=lang("Site.pickup_hours_monday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="pickup_hours_monday_from" name="pickup_hours_monday_from" value="<?=$settings["pickup_hours_monday_from"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_monday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="pickup_hours_monday_to" name="pickup_hours_monday_to" value="<?=$settings["pickup_hours_monday_to"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_monday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pickup_hours_tuesday_from" class="col-sm-3 col-form-label"><?=lang("Site.pickup_hours_tuesday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="pickup_hours_tuesday_from" name="pickup_hours_tuesday_from" value="<?=$settings["pickup_hours_tuesday_from"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_tuesday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="pickup_hours_tuesday_to" name="pickup_hours_tuesday_to" value="<?=$settings["pickup_hours_tuesday_to"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_tuesday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pickup_hours_wednesday_from" class="col-sm-3 col-form-label"><?=lang("Site.pickup_hours_wednesday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="pickup_hours_wednesday_from" name="pickup_hours_wednesday_from" value="<?=$settings["pickup_hours_wednesday_from"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_wednesday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="pickup_hours_wednesday_to" name="pickup_hours_wednesday_to" value="<?=$settings["pickup_hours_wednesday_to"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_wednesday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pickup_hours_thursday_from" class="col-sm-3 col-form-label"><?=lang("Site.pickup_hours_thursday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="pickup_hours_thursday_from" name="pickup_hours_thursday_from" value="<?=$settings["pickup_hours_thursday_from"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_thursday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="pickup_hours_thursday_to" name="pickup_hours_thursday_to" value="<?=$settings["pickup_hours_thursday_to"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_thursday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pickup_hours_friday_from" class="col-sm-3 col-form-label"><?=lang("Site.pickup_hours_friday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="pickup_hours_friday_from" name="pickup_hours_friday_from" value="<?=$settings["pickup_hours_friday_from"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_friday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="pickup_hours_friday_to" name="pickup_hours_friday_to" value="<?=$settings["pickup_hours_friday_to"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_friday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pickup_hours_saturday_from" class="col-sm-3 col-form-label"><?=lang("Site.pickup_hours_saturday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="pickup_hours_saturday_from" name="pickup_hours_saturday_from" value="<?=$settings["pickup_hours_saturday_from"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_saturday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="pickup_hours_saturday_to" name="pickup_hours_saturday_to" value="<?=$settings["pickup_hours_saturday_to"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_saturday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pickup_hours_sunday_from" class="col-sm-3 col-form-label"><?=lang("Site.pickup_hours_sunday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="pickup_hours_sunday_from" name="pickup_hours_sunday_from" value="<?=$settings["pickup_hours_sunday_from"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_sunday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="pickup_hours_sunday_to" name="pickup_hours_sunday_to" value="<?=$settings["pickup_hours_sunday_to"]?>">
                                                <sub class="error_field text-danger" id="pickup_hours_sunday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="col-12 text-danger error_field" id="error_error"></span>
                                            <span class="col-12 text-success error_field" id="success"></span>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary float-right" id="form-submit" onclick="submitForm('pickupHoursSettingsForm')"><?=lang("Site.save")?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="deliveryHoursSettings">
                                    <form action="<?=fullUrl(route_to('admin_route_save_settings'))?>" method="post" class="form-horizontal" id="deliveryHoursSettingsForm">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-5 text-center">
                                                <?=lang("Site.delivery_starts")?>
                                            </div>
                                            <div class="col-sm-5 text-center">
                                                <?=lang("Site.delivery_ends")?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_hours_monday_from" class="col-sm-3 col-form-label"><?=lang("Site.delivery_hours_monday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="delivery_hours_monday_from" name="delivery_hours_monday_from" value="<?=$settings["delivery_hours_monday_from"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_monday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="delivery_hours_monday_to" name="delivery_hours_monday_to" value="<?=$settings["delivery_hours_monday_to"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_monday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_hours_tuesday_from" class="col-sm-3 col-form-label"><?=lang("Site.delivery_hours_tuesday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="delivery_hours_tuesday_from" name="delivery_hours_tuesday_from" value="<?=$settings["delivery_hours_tuesday_from"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_tuesday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="delivery_hours_tuesday_to" name="delivery_hours_tuesday_to" value="<?=$settings["delivery_hours_tuesday_to"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_tuesday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_hours_wednesday_from" class="col-sm-3 col-form-label"><?=lang("Site.delivery_hours_wednesday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="delivery_hours_wednesday_from" name="delivery_hours_wednesday_from" value="<?=$settings["delivery_hours_wednesday_from"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_wednesday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="delivery_hours_wednesday_to" name="delivery_hours_wednesday_to" value="<?=$settings["delivery_hours_wednesday_to"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_wednesday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_hours_thursday_from" class="col-sm-3 col-form-label"><?=lang("Site.delivery_hours_thursday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="delivery_hours_thursday_from" name="delivery_hours_thursday_from" value="<?=$settings["delivery_hours_thursday_from"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_thursday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="delivery_hours_thursday_to" name="delivery_hours_thursday_to" value="<?=$settings["delivery_hours_thursday_to"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_thursday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_hours_friday_from" class="col-sm-3 col-form-label"><?=lang("Site.delivery_hours_friday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="delivery_hours_friday_from" name="delivery_hours_friday_from" value="<?=$settings["delivery_hours_friday_from"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_friday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="delivery_hours_friday_to" name="delivery_hours_friday_to" value="<?=$settings["delivery_hours_friday_to"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_friday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_hours_saturday_from" class="col-sm-3 col-form-label"><?=lang("Site.delivery_hours_saturday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="delivery_hours_saturday_from" name="delivery_hours_saturday_from" value="<?=$settings["delivery_hours_saturday_from"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_saturday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="delivery_hours_saturday_to" name="delivery_hours_saturday_to" value="<?=$settings["delivery_hours_saturday_to"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_saturday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_hours_sunday_from" class="col-sm-3 col-form-label"><?=lang("Site.delivery_hours_sunday")?></label>
                                            <div class="col-sm-4">
                                                <input type="time" class="form-control" id="delivery_hours_sunday_from" name="delivery_hours_sunday_from" value="<?=$settings["delivery_hours_sunday_from"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_sunday_from_error"></sub>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" class="form-control" id="delivery_hours_sunday_to" name="delivery_hours_sunday_to" value="<?=$settings["delivery_hours_sunday_to"]?>">
                                                <sub class="error_field text-danger" id="delivery_hours_sunday_to_error"></sub>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="col-12 text-danger error_field" id="error_error"></span>
                                            <span class="col-12 text-success error_field" id="success"></span>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary float-right" id="form-submit" onclick="submitForm('deliveryHoursSettingsForm')"><?=lang("Site.save")?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>
    </div>

<?=view('includes/js/form')?>