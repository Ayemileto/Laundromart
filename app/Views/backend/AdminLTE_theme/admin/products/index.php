    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <span><?=$title?></span>
                            <span class="float-sm-right">
                                <button class="btn btn-primary" onclick="showModal('<?=fullUrl(route_to('admin_route_add_product'))?>', `<?=lang('Site.add_product')?>`)"><?=lang('Site.add_product')?></button>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row">
        <?php foreach($products AS $product):?>
                                <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch" id="product_div_<?=$product['id']?>">
                                    <div class="card bg-light">
                                        <div class="card-body pt-2">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <img src="<?=showProductImage($product["file"])?>" class="img-circle img-fluid" alt="Product Image" height="125" width="125">
                                                </div>
                                                <div class="col-12 pt-3">
                                                    <h2 class="lead"><b><?=$product['name']?></b></h2>
                                                    <p class="card-text"><?=$product["description"]?></p>
                                                    <p class="text-muted text-sm"><b>Price: </b> <?=getProductPriceRange($product['prices'])?> <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between">
                                                <a href="#" onclick="showModal('<?=fullUrl(route_to('admin_route_edit_product', $product['id']))?>', '<?=lang('Site.edit_product')?>')" class="btn btn-sm bg-teal" data-toggle="tooltip" title="<?=lang('Site.edit_product')?>">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="#" id="deactivate_btn_<?=$product['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_deactivate_product', $product['id']))?>', this.id, true, 'activate_btn_<?=$product['id']?>', '', 'bg-warning')" class="btn btn-sm bg-warning" <?=$product["status"] == "active" ? '' : 'style="display:none"' ; ?> data-toggle="tooltip" title="<?=lang("Site.deactivate_product")?>">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                                <a href="#" id="activate_btn_<?=$product['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_activate_product', $product['id']))?>', this.id, true, 'deactivate_btn_<?=$product['id']?>', '', 'bg-olive')" class="btn btn-sm bg-olive" <?=$product["status"] == "active" ? 'style="display:none"' : '' ; ?> data-toggle="tooltip" title="<?=lang("Site.activate_product")?>">
                                                    <i class="fas fa-redo"></i>
                                                </a>
                                                <a href="#" id="delete_btn_<?=$product['id']?>" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_product', $product['id']))?>', this.id, true, '', '#product_div_<?=$product['id']?>', 'bg-danger')" class="btn btn-sm bg-danger" data-toggle="tooltip" title="<?=lang("Site.delete_product")?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        <?php endforeach ?>

                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <?=$pager->links()?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?=view('includes/js/modal')?>