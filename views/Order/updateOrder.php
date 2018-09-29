<main id="OrderId" data-order-id="<?= $this->view->order->orderID ?>" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div>
        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <script defer src="assets/js/order.js" ></script>

    <h2>Обновление заказа</h2>

    <?php
        $userName = $this->view->order->userName;
        $userEmail = $this->view->order->userEmail;
        $userPhone = $this->view->order->userPhone;
        $userName = $this->view->order->userName;
        $userName = $this->view->order->userName;

        $total = 0;

    ?>
    <form  class="col-6">
        <div class="form-group">
            <label for="UserName">Имя</label>
            <input class="form-control" id="UserName"  data-user-id="<?= $this->view->order->userID ?>"  placeholder="" value="<?=  $userName ?>">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" id="email" placeholder="" value="<?=  $userEmail ?>">
        </div>

        <div class="form-group">
            <label for="phone">Номер телефона</label>
            <input class="form-control" id="phone" placeholder="" value="<?=  $userPhone ?>" >
        </div>

        <div class="form-group">
            <label for="аddress">Адрес доставки</label>
            <input class="form-control" id="аddress" placeholder="" value="<?=  $this->view->order->deliveryAddressOrder ?>">
        </div>


        <div class="form-group">
            <label for="comment">Комментарий к заказу</label>
            <textarea type="password" class="form-control" id="comment" placeholder=""><?=  $this->view->order->commentToTheOrder ?></textarea>
        </div>


        <div class="form-group">
            <label for="statusOrder">Статус заказа</label>
            <select class="form-control" id="statusOrder">

                <?php foreach ($this->view->statuses as $status) { ?>
                    <option value="<?= $status->statusID ?>"><?= $status->statusTitle ?> </option>
                <?php } ?>

            </select>

        </div>

        <div class="form-group">
            <h4 for="products">Список товаров:</h4>
            <table class="table table-striped table-sm">
                <thead>
                <tr align="center" text-align="center">
                    <th>ID</th>
                    <th>Название</th>
                    <th>Кол-во</th>
                    <th>Стоимость</th>
                    <th>Цена</th>
                    <th align="center" text-align="center">Удалить</th>
                </tr>
                </thead>
                <tbody id="productsTable">

                <?php foreach ( $this->view->products as $product) { ?>
                    <tr data-orderdetails-id="<?= $product->orderDetailsID ?>">

                        <td align="center"  ><?= $product->id ?></td>
                        <td> <?= $product->title ?> </td>
                        <td align="center" text-align="center" ><?= $product->amount ?></td>
                        <td align="center" text-align="center" ><?= $product->price ?></td>
                        <td align="center" text-align="center"  ><?= $product->price * $product->amount ?></td>
                        <td align="center" text-align="center" > <button id ="deleteProductButton" data-orderdetails-id="<?= $product->orderDetailsID ?>" class="btn btn-danger" >&#10008;</button> </td>

                        <?php
                            $total +=  ($product->price * $product->amount);
                        ?>
                    </tr>
                <?php }//foreach ?>

                    <tr id="sum">

                        <td></td>
                        <td> <strong>Итого: </strong></td>
                        <td></td>
                        <td></td>
                        <td align="center"> <strong><?= $total ?> руб </strong> </td>

                    </tr>

                </tbody>

            </table>
        </div>



        <div id ="updateOrderButton" class="btn btn-primary">Обновить заказ</div>

        <div id="errorMessage" style="display: none" class="alert alert-danger">Ошибка обновления заказа !</div>
        <div id="successMessage" style="display: none" class="alert alert-success">Информация о заказе обновлена !</div>

    </form>



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
                    <p>Вы действительно хотите удалить продукт из заказа ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <button id="confirmRemoveProduct" type="button" class="btn btn-primary" data-dismiss="modal">Удалить</button>
                </div>
            </div>
        </div>
    </div>


</main>
</div>
</div>

