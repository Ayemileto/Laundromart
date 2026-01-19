<div class="my-2">
    <form method="post" action="<?=fullUrl(route_to('admin_route_update_role', $role['id']))?>" id="edit_role_form">
        <div class="form-group">
            <div class="row">
                <div class="col-12 col-md-2"> 
                    <label for="name"><?=lang('Site.name')?></label>
                </div>
                <div class="col-12 col-md-10">
                    <input type="hidden" name="id" value="<?=$role['id']?>" required>
                    <input type="text" name="name" class="form-control" maxlength="255" placeholder="<?=lang('Site.name')?>" value="<?=$role['name']?>" required>
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
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_setting']?>" value="<?=$permissions['update_setting']?>" <?=in_array($permissions['update_setting'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_setting']?>" value="<?=$permissions['view_setting']?>" <?=in_array($permissions['view_setting'], $role_permissions) ? 'checked' : ''?>>
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
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_payment_setting']?>" value="<?=$permissions['update_payment_setting']?>" <?=in_array($permissions['update_payment_setting'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    -
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_payment_setting']?>" value="<?=$permissions['view_payment_setting']?>" <?=in_array($permissions['view_payment_setting'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.invoices')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_invoice']?>" value="<?=$permissions['add_invoice']?>" <?=in_array($permissions['add_invoice'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_invoice']?>" value="<?=$permissions['update_invoice']?>" <?=in_array($permissions['update_invoice'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_invoice']?>" value="<?=$permissions['delete_invoice']?>" <?=in_array($permissions['delete_invoice'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_invoice']?>" value="<?=$permissions['view_invoice']?>" <?=in_array($permissions['view_invoice'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.orders')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_order']?>" value="<?=$permissions['add_order']?>" <?=in_array($permissions['add_order'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_order']?>" value="<?=$permissions['update_order']?>" <?=in_array($permissions['update_order'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_order']?>" value="<?=$permissions['delete_order']?>" <?=in_array($permissions['delete_order'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_order']?>" value="<?=$permissions['view_order']?>" <?=in_array($permissions['view_order'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.subscriptions')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_subscription']?>" value="<?=$permissions['add_subscription']?>" <?=in_array($permissions['add_subscription'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_subscription']?>" value="<?=$permissions['update_subscription']?>" <?=in_array($permissions['update_subscription'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_subscription']?>" value="<?=$permissions['delete_subscription']?>" <?=in_array($permissions['delete_subscription'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_subscription']?>" value="<?=$permissions['view_subscription']?>" <?=in_array($permissions['view_subscription'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.shipping')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_shipping']?>" value="<?=$permissions['add_shipping']?>" <?=in_array($permissions['add_shipping'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_shipping']?>" value="<?=$permissions['update_shipping']?>" <?=in_array($permissions['update_shipping'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_shipping']?>" value="<?=$permissions['delete_shipping']?>" <?=in_array($permissions['delete_shipping'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_shipping']?>" value="<?=$permissions['view_shipping']?>" <?=in_array($permissions['view_shipping'], $role_permissions) ? 'checked' : ''?>>
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
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_calendar']?>" value="<?=$permissions['view_calendar']?>" <?=in_array($permissions['view_calendar'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.products')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_product']?>" value="<?=$permissions['add_product']?>" <?=in_array($permissions['add_product'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_product']?>" value="<?=$permissions['update_product']?>" <?=in_array($permissions['update_product'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_product']?>" value="<?=$permissions['delete_product']?>" <?=in_array($permissions['delete_product'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_product']?>" value="<?=$permissions['view_product']?>" <?=in_array($permissions['view_product'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.product_services')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_product_service']?>" value="<?=$permissions['add_product_service']?>" <?=in_array($permissions['add_product_service'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_product_service']?>" value="<?=$permissions['update_product_service']?>" <?=in_array($permissions['update_product_service'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_product_service']?>" value="<?=$permissions['delete_product_service']?>" <?=in_array($permissions['delete_product_service'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_product_service']?>" value="<?=$permissions['view_product_service']?>" <?=in_array($permissions['view_product_service'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.subscription_plans')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_plan']?>" value="<?=$permissions['add_plan']?>" <?=in_array($permissions['add_plan'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_plan']?>" value="<?=$permissions['update_plan']?>" <?=in_array($permissions['update_plan'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_plan']?>" value="<?=$permissions['delete_plan']?>" <?=in_array($permissions['delete_plan'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_plan']?>" value="<?=$permissions['view_plan']?>" <?=in_array($permissions['view_plan'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.users')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_user']?>" value="<?=$permissions['add_user']?>" <?=in_array($permissions['add_user'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_user']?>" value="<?=$permissions['update_user']?>" <?=in_array($permissions['update_user'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_user']?>" value="<?=$permissions['delete_user']?>" <?=in_array($permissions['delete_user'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_user']?>" value="<?=$permissions['view_user']?>" <?=in_array($permissions['view_user'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.staffs')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_staff']?>" value="<?=$permissions['add_staff']?>" <?=in_array($permissions['add_staff'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_staff']?>" value="<?=$permissions['update_staff']?>" <?=in_array($permissions['update_staff'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_staff']?>" value="<?=$permissions['delete_staff']?>" <?=in_array($permissions['delete_staff'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_staff']?>" value="<?=$permissions['view_staff']?>" <?=in_array($permissions['view_staff'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.roles_and_permission')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_role']?>" value="<?=$permissions['add_role']?>" <?=in_array($permissions['add_role'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_role']?>" value="<?=$permissions['update_role']?>" <?=in_array($permissions['update_role'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_role']?>" value="<?=$permissions['delete_role']?>" <?=in_array($permissions['delete_role'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_role']?>" value="<?=$permissions['view_role']?>" <?=in_array($permissions['view_role'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.office_branches')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_branch']?>" value="<?=$permissions['add_branch']?>" <?=in_array($permissions['add_branch'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_branch']?>" value="<?=$permissions['update_branch']?>" <?=in_array($permissions['update_branch'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_branch']?>" value="<?=$permissions['delete_branch']?>" <?=in_array($permissions['delete_branch'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_branch']?>" value="<?=$permissions['view_branch']?>" <?=in_array($permissions['view_branch'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4"> 
                    <label><?=lang('Site.pickup_delivery_locations')?></label>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['add_location']?>" value="<?=$permissions['add_location']?>" <?=in_array($permissions['add_location'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['update_location']?>" value="<?=$permissions['update_location']?>" <?=in_array($permissions['update_location'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['delete_location']?>" value="<?=$permissions['delete_location']?>" <?=in_array($permissions['delete_location'], $role_permissions) ? 'checked' : ''?>>
                </div>
                <div class="form-check col-2">
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_location']?>" value="<?=$permissions['view_location']?>" <?=in_array($permissions['view_location'], $role_permissions) ? 'checked' : ''?>>
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
                    <input type="checkbox" class="form-check-input mx-auto" name="permission[]" id="check_<?=$permissions['view_statistic']?>" value="<?=$permissions['view_statistic']?>" <?=in_array($permissions['view_statistic'], $role_permissions) ? 'checked' : ''?>>
                </div>
            </div>
        </div>
        <span class="text-success error_field" id="success"></span>
        <span class="text-danger error_field" id="error"></span>          
        
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang("Site.close")?></button>
            <button type="submit" class="btn btn-primary mt-2" id="form-submit" onclick="submitForm('edit_role_form')"><?=lang("Site.edit_role")?></button>
        </div>
    </form>
</div>
<?=view("includes/js/form")?>