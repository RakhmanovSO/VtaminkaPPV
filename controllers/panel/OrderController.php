<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 16.09.2018
 * Time: 11:38
 */

namespace controllers\panel;

use models\order\Order;
use models\order\OrderDetails;
use models\order\OrderStatus;

class OrderController extends BaseController {


    public function statusesAction(  ){

        $statuses = OrderStatus::GetOrderStatusesList(100,0);

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

    public function ordersAction(  ){

        return 'orders-list';

    }// addStatusAction


    /// Вывод заказов

    public function ordersListAction(  ){

        $this->view->orders = Order::getOrdersList();

        return 'orders-list';

    }//ordersListAction

    /// Удаление заказа

    public function removeOrderAction(  ){

        $orderID = $this->request->getDeleteValue('orderID');


        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{

            $result = Order::removeOrder( $orderID );

            $response['code'] = 200;
            $response['message'] = 'Заказ удален!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'orderID' => $orderID
            );

        }//catch


        $this->json($response);


    }//removeOrderAction


    //Обновление заказа
    public function updateOrderAction( ){

        $this->view->statuses = OrderStatus::GetOrderStatusesList();

        $orderID = $this->request->getGetValue('orderID');

        $order = Order::getOrderById ( $orderID );

        $this->view->order = $order;

        $this->view->products = OrderDetails::getDetailsByOrder($orderID);

        return 'updateOrder';

    }// updateOrderAction



    public function saveOrderAction(  ){


        $statusID = $this->request->getPostValue('statusID');

        $userID  = $this->request->getPostValue('userID');

        $userName  = $this->request->getPostValue('userName');

        $userEmail  = $this->request->getPostValue('userEmail');

        $userPhone  = $this->request->getPostValue('userPhone');



        $orderID = $this->request->getPostValue('orderID');

        $dateAndTimeOrder =  date('Y-m-d H:i:s');

        $deliveryAddressOrder = $this->request->getPostValue('deliveryAddressOrder');

        $commentToTheOrder = $this->request->getPostValue('commentToTheOrder');



       // $orderDetailsID = $this->request->getPostValue('orderDetailsID');

       // $productID = $this->request->getPostValue('productID');

      //  $amountProduct = $this->request->getPostValue('amountProduct');

       // $productPrice = $this->request->getPostValue('productPrice');



            $response = array (
            'code' => -1,
            'message' => '',
            'data' => ''     );

        try{

            Order::updateUser($userID, $userName, $userEmail, $userPhone );

            // OrderDetails::updateOrderDetails ($orderDetailsID, $productID, $amountProduct, $productPrice);

            Order::updateOrder( $orderID , $statusID, $dateAndTimeOrder, $deliveryAddressOrder , $commentToTheOrder , $userID );

            $response['code'] = 200;
            $response['message'] = 'Заказ обновлен успешно!';

        }//try
        catch( \Exception $ex ){

            $response['code'] = 500;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'userID' => $userID,
                'statusID' => $statusID,
                'orderID' => $orderID,
                'dateAndTimeOrder' => $dateAndTimeOrder
            );

        }//catch

        $this->json( $response );


    }//saveOrderAction



    public function removeProductInOrderAction(){


        $orderDetailsID = $this->request->getDeleteValue('orderDetailsID');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{

            $result = OrderDetails::removeOrderDetails ($orderDetailsID);

            $response['code'] = 200;
            $response['message'] = 'Продукт из заказа удален!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'orderDetailsID' => $orderDetailsID,
            );

        }//catch

        $this->json($response);



    }//removeProductInOrderAction



}//OrderController