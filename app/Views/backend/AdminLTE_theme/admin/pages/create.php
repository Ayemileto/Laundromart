<?=view('includes/css/summernote')?>
<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <form enctype="multipart/form-data" method="post" action="<?=fullUrl(route_to('admin_route_save_page'))?>" id="add_page">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-2"> 
                                <label for="name"><?=lang("Site.name")?></label>
                            </div>
                            <div class="col-12 col-md-10"> 
                                <input class="form-control" name="name" type="text" maxlength="255" placeholder="<?=lang("Site.name")?>" value="" required>
                                <sub class="form-text error_field text-danger" id="name_error"></sub>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-2"> 
                                <label for="title"><?=lang("Site.title")?></label>
                            </div>
                            <div class="col-12 col-md-10"> 
                                <input class="form-control" name="title" type="text" placeholder="<?=lang("Site.title")?>" value="">
                                <sub class="form-text error_field text-danger" id="title_error"></sub>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-2"> 
                                <label for="content"><?=lang("Site.content")?></label>
                            </div>
                            <div class="col-12 col-md-10"> 
                                <textarea name="content" class="form-control summernote-textarea" maxlength="255" placeholder="<?=lang("Site.content")?>" value="" required></textarea>
                                <sub class="form-text text-danger error_field" id="content_error"></sub>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-2"> 
                                <label for="top_menu"><?=lang("Site.show_on_top_menu")?></label>
                            </div>
                            <div class="col-12 col-md-10"> 
                                <select name="top_menu" id="top_menu" class="form-control">
                                    <option value=""></option>
                                    <option value="no" selected><?=lang('Site.no')?></option>
                                    <option value="yes"><?=lang('Site.yes')?></option>
                                    <sub class="form-text text-danger error_field" id="top_menu_error"></sub>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <label for="bottom_menu"><?=lang("Site.show_on_bottom_menu")?></label>
                            </div>
                            <div class="col-12 col-md-10"> 
                                <select name="bottom_menu" id="bottom_menu" class="form-control">
                                    <option value=""></option>
                                    <option value="no" selected><?=lang('Site.no')?></option>
                                    <option value="yes"><?=lang('Site.yes')?></option>
                                    <sub class="form-text text-danger error_field" id="bottom_menu_error"></sub>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <label for="status"><?=lang("Site.status")?></label>
                            </div>
                            <div class="col-12 col-md-10">
                                <select name="status" id="status" class="form-control">
                                    <option value=""></option>
                                    <option value="active" selected><?=lang('Site.active')?></option>
                                    <option value="inactive"><?=lang('Site.inactive')?></option>
                                    <sub class="form-text text-danger error_field" id="status_error"></sub>
                                </select>
                            </div>
                        </div>
                    </div>

                    <span class="text-success error_field" id="success"></span>
                    <span class="text-danger error_field" id="error"></span>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.close")?></button>
                        <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('add_page')"><?=lang("Site.save")?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?=view('includes/js/form')?>
<?=view('includes/js/summernote')?>