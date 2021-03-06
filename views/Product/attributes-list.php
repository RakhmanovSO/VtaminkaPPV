<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <script defer src="assets/js/category.js" ></script>
    <h2>Атрибуты товаров </h2>

    <form class="col-12">
        <div class="form-group">
            <a href="index.php?ctrl=Product&act=addAttribute" class="btn btn-primary">Добавить атрибут</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Remove</th>
                <th>Update</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ( $this->view->attributes as $atribute ) { ?>
                <tr data-attribute-id="<?= $atribute->attributeID ?>">

                    <td><?= $atribute->attributeID ?></td>
                    <td><?= $atribute->attributeTitle ?></td>
                    <td><button data-category-id="<?= $atribute->attributeID ?>" class="btn btn-danger" >Remove</button></td>
                    <td><a class="btn btn-primary" href="?ctrl=Category&act=update">Update</a></td>

                </tr>
            <?php }//foreach ?>

            </tbody>
        </table>
    </div>

    <div id="removeAttributeModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Сообщение</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить данный атрибут?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <button id="confirmRemoveAttribute" type="button" class="btn btn-primary" data-dismiss="modal">Удалить</button>
                </div>
            </div>
        </div>
    </div>

</main>
</div>
</div>

