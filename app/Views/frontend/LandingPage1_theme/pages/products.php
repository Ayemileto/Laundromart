        <div class="wrapper">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card-deck">
                    <?php
                            $productsServicesPricesModel = new \App\Models\ProductsServicesPricesModel();
                            foreach($products AS $product):
                            $productServices = $productsServicesPricesModel->getProductServices($product['id']);
                    ?>
                            <div class="card mb-4 box-shadow" style="min-width: 15rem;max-width: 15rem;">
                                <div class="card-header border-0">
                                    <img src="<?=showProductImage($product["file"])?>" alt="Product Image" class="card-img-top" style="height:200px;width:200px;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?=$product['name']?></h5>
                                    <div class="card-text">
                                        <p><?=$product["description"]?></p>
                                        <div>
                                            <h6><?=getProductPriceRange($product['prices'])?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <button class="btn btn-primary w-100" onclick="showModal('<?=fullUrl(route_to('product_services', $product['id']))?>', '<?=lang('Site.select_service')?>', 'md')">Add to Cart</button>
                                </div>
                            </div>
                    <?php
                    endforeach;
                    ?>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-5">
                        <?=$pager->links()?>
                    </div>
                </div>
            </div>
        </div>

<?=view('includes/js/modal')?>