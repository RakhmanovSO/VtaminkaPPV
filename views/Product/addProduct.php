<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <script defer src="assets/js/product.js" ></script>
    <h2>Добавление товара</h2>

    <form>
        <div class="form-group">
            <label for="productTitle">Нозвание товара</label>
            <input class="form-control" id="productTitle" placeholder="Введите название">
        </div>
        <div class="form-group">
            <label for="productPrice">Цена товара</label>
            <input class="form-control" id="productPrice" placeholder="Введите цену">
        </div>
        <div class="form-group">
            <label for="productCategories">Категории</label>
            <select class="form-control" id="productCategories" multiple >
                <?php foreach ($this->view->categories as $category) { ?>
                    <option
                            value="<?= $category->categoryID ?>"><?= $category->categoryTitle ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="productAttributes">Атрибуты</label>
            <select class="form-control" id="productAttributes">
                <option value="-1">Добавить атрибут</option>
                <?php foreach ($this->view->attributes as $attribute) { ?>
                    <option
                            value="<?= $attribute->attributeID ?>"
                            data-attribute-title="<?= $attribute->attributeTitle ?>"
                    ><?= $attribute->attributeTitle ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="attributeValue">Значение атрибута</label>
            <input class="form-control" id="attributeValue" placeholder="Введите значение">
        </div>
        <div class="form-group">
            <DIV id="addAttributeToProduct" class="btn btn-primary">Добавить атрибут</DIV>
        </div>
        <div class="form-group">
            <label for="productPrice">Список установленных атрибутов</label>
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Значение</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody id="attributesTable">

                </tbody>
            </table>
        </div>


        <div class="form-group">
            <label for="productDescription">Описание</label>
            <textarea type="password" class="form-control" id="productDescription" placeholder="Введите описание">

            </textarea>
        </div>
        <DIV class="btn btn-primary">Добавить товар</DIV>
    </form>