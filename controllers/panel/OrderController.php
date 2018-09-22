<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 16.09.2018
 * Time: 11:38
 */

namespace controllers\panel;

use models\order\Order;
use models\order\OrderStatus;

class OrderController extends BaseController {


    public function statusesAction(  ){

        $statuses = OrderStatus::GetOrderStatusesList();

        $this->view->statuses = $statuses;

        return 'statuses-list';

    }//statusesAction


    //AJAX {{POST}}
    public function addStatusAction(  ){


        $title = $this->request->getPostValue('statusTitle');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        $result = OrderStatus::AddNewStatus( $title );

        $response['code'] = 200;
        $response['data'] = $result;

        $this->json($response);

    }//

    /// Вывод заказов
// http://localhost:5012/VtaminkaPPV/index.php?ctrl=Order&act=ordersList

    public function ordersListAction(  ){

        $this->view->orders = Order::getOrdersList();

        return 'orders-list';

    }







}//OrderController