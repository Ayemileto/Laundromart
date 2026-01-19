<?=view('includes/css/summernote')?>
<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <form enctype="multipart/form-data" method="post" action="<?=fullUrl(route_to('admin_route_update_page', $page['id']))?>" id="edit_page">
                    <input type="hidden" name="page_id" class="form-control" value="<?=$page["id"]?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-2"> 
                                <label for="name"><?=lang("Site.name")?></label>
                            </div>
                            <div class="col-12 col-md-10"> 
                                <input class="form-control" name="name" type="text" maxlength="255" placeholder="<?=lang("Site.name")?>" value="<?=$page['name']?>" required>
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
                                <input class="form-control" name="title" type="text" maxlength="255" placeholder="<?=lang("Site.title")?>" value="<?=$page['title']?>">
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
                                <textarea name="content" class="form-control summernote-textarea" placeholder="<?=lang("Site.content")?>" required>
                                    <?=$page['content']?>
                                </textarea>
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
                                    <option value="no" <?=$page['top_menu']=='no'? 'selected' : ''?>><?=lang('Site.no')?></option>
                                    <option value="yes" <?=$page['top_menu']=='yes'? 'selected' : ''?>><?=lang('Site.yes')?></option>
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
                                    <option value="no" <?=$page['bottom_menu']=='no'? 'selected' : ''?>><?=lang('Site.no')?></option>
                                    <option value="yes" <?=$page['bottom_menu']=='yes'? 'selected' : ''?>><?=lang('Site.yes')?></option>
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
                                    <option value="active" <?=$page['status']=='active'? 'selected' : ''?>><?=lang('Site.active')?></option>
                                    <option value="inactive" <?=$page['status']=='inactive'? 'selected' : ''?>><?=lang('Site.inactive')?></option>
                                    <sub class="form-text text-danger error_field" id="status_error"></sub>
                                </select>
                            </div>
                        </div>
                    </div>

                    <span class="text-success error_field" id="success"></span>
                    <span class="text-danger error_field" id="error"></span>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.close")?></button>
                        <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('edit_page')"><?=lang("Site.save")?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?=view('includes/js/form')?>
<?=view('includes/js/summernote')?>