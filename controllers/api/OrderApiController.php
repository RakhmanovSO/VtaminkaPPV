<?php

namespace controllers\api;

use controllers\panel\BaseController;
use models\Order\Order;
use models\Order\OrderDetails;
use models\Order\OrderStatus;


class OrderApiController  extends BaseController{


    // API-метод для добавления Заказа

    public function AddOrderAction (  ){

        $userName = $this->request->getPostValue('userName');
        $userEmail = $this->request->getPostValue('userEmail');
        $userPhone = $this->request->getPostValue('userPhone');
        $deliveryAddressOrder = $this->request->getPostValue('deliveryAddressOrder');
        $commentToTheOrder = $this->request->getPostValue('commentToTheOrder');
        $numberCard = $this->request->getPostValue('numberCard');
        $yearCard  = $this->request->getPostValue('yearCard');
        $monthСard  = $this->request->getPostValue('monthСard');
        $cvvCode  = $this->request->getPostValue('cvvCode');
        $cardName  = $this->request->getPostValue('cardName');

        $params = array();

        $params['cardNumber'] = $numberCard;
        $params['name'] = $cardName;
        $params['year'] = $yearCard;
        $params['month'] = $monthСard;
        $params['securityCode']  = $cvvCode;
        $params['statusID'] = 1;
        $params['address'] = $deliveryAddressOrder;
        $params['comment'] = $commentToTheOrder;
        $params['userEmail'] = $userEmail;
        $params['userName'] = $userName;
        $params['userPhone'] = $userPhone;
        $params['details'] = $_POST['details'];


        $newOrder = Order::addOrder($params);


        $this->json( array(
            'order' => $newOrder
        ) );

    }//AddOrderAction


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

