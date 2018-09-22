<?php

namespace models\order;

use utils\MySQL;

class Order
{

    public $orderID;
    public $statusID;
    public $dateAndTimeOrder;
    public $deliveryAddressOrder;
    public $commentToTheOrder;
    public $userID;
    public $orderDetailsID;


    public static function getOrdersList( $limit = 10 , $offset = 0){


        $stm = MySQL::$db->prepare("SELECT o.orderID, o.dateAndTimeOrder, o.deliveryAddressOrder, orst.statusTitle 
                                    FROM `orders` as `o` INNER JOIN `orderstatuses` as `orst` 
                                    ON `o`.statusID = `orst`.statusID LIMIT $offset, $limit");



        $stm->execute();

        $orders = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $orders;

    }//GetOrders


    public static function getOrderById( $orderID ) {

        $stm = MySQL::$db->prepare ("SELECT * FROM `orders` as `o` 
                                      INNER JOIN `orderstatuses` as `orst` ON `o`.statusID = `orst`.statusID 
                                      INNER JOIN `orderdetails` as `od` ON `o`.orderDetailsID = `od`.orderDetailsID 
                                      INNER JOIN `users` as `u` ON `o`.userID = `u`.userID 
                                      WHERE orderID = :id");

        $stm->bindParam( ":id" , $orderID , \PDO::PARAM_INT);

        $stm->execute();

        $orders = $stm->fetch(\PDO::FETCH_OBJ);

        return $orders;

    }//getOrderById






}