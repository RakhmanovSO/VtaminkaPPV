<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <script defer src="assets/js/category.js" ></script>
    <h2>Товары в категории "<?= $this->view->category->categoryTitle ?>"</h2>
    <form class="col-8">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Удалить</th>
                    <th>Обновить</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ( $this->view->products as $product) { ?>
                    <tr data-product-id="<?= $product->productID ?>">

                        <td><?= $product->productID ?></td>
                        <td><?= $product->productTitle ?></td>
                        <td><?= $product->productPrice ?></td>
                        <td><button data-product-id="<?= $product->productID ?>" class="btn btn-danger" >Удалить</button></td>
                        <td><a class="btn btn-primary" href="?ctrl=Product&act=updateProduct">Обновить</a></td>

                    </tr>
                <?php }//foreach ?>

                </tbody>
            </table>
        </div>

        <div id="removeProductModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Сообщение</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Вы действительно хотите удалить данный товар?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                        <button id="confirmRemoveProduct" type="button" class="btn btn-primary" data-dismiss="modal">Удалить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>