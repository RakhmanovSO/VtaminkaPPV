<?php

namespace controllers\api;

use controllers\panel\BaseController;
use models\Order\Order;
use models\Order\OrderDetails;
use models\Order\OrderStatus;


class OrderApiController  extends BaseController{




// API-метод получения заказа по ID
//GET-метод

    public function GetOrderListByIdAction (  ){

        $response = array(
            'code' => 0,
            'message' => 0,
            'data' => 0
        );

        $orderID = $this->request->getGetValue('orderID');


        $order = Order::getOrderById ($orderID);

        $response['code'] = 200;

        $response['data'] = $order;

        $this->json($response);

    }//GetProductsList



}//OrderApiController