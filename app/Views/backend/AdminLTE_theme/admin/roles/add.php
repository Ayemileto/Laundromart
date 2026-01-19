<div class="my-2">
    <form method="post" action="<?=base_url().route_to('admin_route_save_role')?>" id="add_role_form">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="name"><?=lang('Site.name')?></label>
                </div>
                <div class="col-12 col-md-10">
                    <input type="text" name="name" class="form-control" maxlength="255" placeholder="<?=lang('Site.name')?>" value="" required>
                    <sub class="form-text text-danger error_field" id="name_error"></sub>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12"> 
                    <label for="permission"><?=lang('Site.select_permissions')?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <!-- <label><?=lang('Site.permission_name')?></label> -->
                </div>
                <div class="col-2">
                    <?=lang('Site.can_add')?>
                </div>
                <div class="col-2">
                    <?=lang('Site.can_edit')?>
                </div>
                <div class="col-2">
                    <?=lang('Site.can_delete')?>
                </div>
                <div class="col-2">
                    <?=lang('Site.can_view')?>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.settings')?></label>
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_setting']?>" value="<?=$permissions['update_setting']?>">
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_setting']?>" value="<?=$permissions['view_setting']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.payment_settings')?></label>
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_payment_setting']?>" value="<?=$permissions['update_payment_setting']?>">
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_payment_setting']?>" value="<?=$permissions['view_payment_setting']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.invoices')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_invoice']?>" value="<?=$permissions['add_invoice']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_invoice']?>" value="<?=$permissions['update_invoice']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_invoice']?>" value="<?=$permissions['delete_invoice']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_invoice']?>" value="<?=$permissions['view_invoice']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.orders')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_order']?>" value="<?=$permissions['add_order']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_order']?>" value="<?=$permissions['update_order']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_order']?>" value="<?=$permissions['delete_order']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_order']?>" value="<?=$permissions['view_order']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.subscriptions')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_subscription']?>" value="<?=$permissions['add_subscription']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_subscription']?>" value="<?=$permissions['update_subscription']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_subscription']?>" value="<?=$permissions['delete_subscription']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_subscription']?>" value="<?=$permissions['view_subscription']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.shipping')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_shipping']?>" value="<?=$permissions['add_shipping']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_shipping']?>" value="<?=$permissions['update_shipping']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_shipping']?>" value="<?=$permissions['delete_shipping']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_shipping']?>" value="<?=$permissions['view_shipping']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.calendar')?></label>
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_calendar']?>" value="<?=$permissions['view_calendar']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.products')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_product']?>" value="<?=$permissions['add_product']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_product']?>" value="<?=$permissions['update_product']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_product']?>" value="<?=$permissions['delete_product']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_product']?>" value="<?=$permissions['view_product']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.product_services')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_product_service']?>" value="<?=$permissions['add_product_service']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_product_service']?>" value="<?=$permissions['update_product_service']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_product_service']?>" value="<?=$permissions['delete_product_service']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_product_service']?>" value="<?=$permissions['view_product_service']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.subscription_plans')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_plan']?>" value="<?=$permissions['add_plan']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_plan']?>" value="<?=$permissions['update_plan']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_plan']?>" value="<?=$permissions['delete_plan']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_plan']?>" value="<?=$permissions['view_plan']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.users')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_user']?>" value="<?=$permissions['add_user']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_user']?>" value="<?=$permissions['update_user']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_user']?>" value="<?=$permissions['delete_user']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_user']?>" value="<?=$permissions['view_user']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.staffs')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_staff']?>" value="<?=$permissions['add_staff']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_staff']?>" value="<?=$permissions['update_staff']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_staff']?>" value="<?=$permissions['delete_staff']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_staff']?>" value="<?=$permissions['view_staff']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.roles_and_permission')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_role']?>" value="<?=$permissions['add_role']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_role']?>" value="<?=$permissions['update_role']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_role']?>" value="<?=$permissions['delete_role']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_role']?>" value="<?=$permissions['view_role']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.office_branches')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_branch']?>" value="<?=$permissions['add_branch']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_branch']?>" value="<?=$permissions['update_branch']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_branch']?>" value="<?=$permissions['delete_branch']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_branch']?>" value="<?=$permissions['view_branch']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.pickup_delivery_locations')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_location']?>" value="<?=$permissions['add_location']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_location']?>" value="<?=$permissions['update_location']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_location']?>" value="<?=$permissions['delete_location']?>">
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_location']?>" value="<?=$permissions['view_location']?>">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.analytics')?></label>
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_statistic']?>" value="<?=$permissions['view_statistic']?>">
                </div>
            </div>
        </div>
        <span class="text-success error_field" id="success"></span>
        <span class="text-danger error_field" id="error"></span>          
        
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.close")?></button>
            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('add_role_form')"><?=lang("Site.add_role")?></button>
        </div>
    </form>
</div>
<?=view("includes/js/form")?>