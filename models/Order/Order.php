<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 16.09.2018
 * Time: 11:32
 */

namespace models\order;

use models\user\CreditCard;
use models\user\User;
use utils\MySQL;

class Order
{

    public $orderID;
    public $statusID;
    public $dateAndTimeOrder;
    public $deliveryAddressOrder;
    public $commentToTheOrder;
    public $userID;


    public function __construct(
        $statusID ,
        $deliveryAddressOrder ,
        $commentToTheOrder,
        $userEmail,
        $userName,
        $userPhone
    ){

        $stm = MySQL::$db->prepare ("
                INSERT INTO orders(`orderID`, `statusID`, `dateAndTimeOrder`, `deliveryAddressOrder`, `commentToTheOrder`, `userID`) 
                VALUES(DEFAULT  , :statusID , now() , :address , :comment , :userID)
        ");


        $user = User::getUserByEmail( $userEmail);

        if(!$user){

            $user = new User(
                $userName,
                $userEmail,
                $userPhone
            );

        }//if

        $stm->bindParam( ":statusID" , $statusID, \PDO::PARAM_INT);

        $stm->bindParam( ":address" ,$deliveryAddressOrder, \PDO::PARAM_STR);

        $stm->bindParam( ":comment" , $commentToTheOrder, \PDO::PARAM_STR);

        $stm->bindParam( ":userID" , $user->userID, \PDO::PARAM_STR);

        $result = $stm->execute();

        $info = MySQL::$db->errorInfo();

        $this->orderID = MySQL::$db->lastInsertId();

        return $result;

    }

    public static function getOrdersList( $limit = 10 , $offset = 0){


        $stm = MySQL::$db->prepare("SELECT o.orderID, o.dateAndTimeOrder, o.deliveryAddressOrder, orst.statusTitle 
                                    FROM `orders` as `o` INNER JOIN `orderstatuses` as `orst` 
                                    ON `o`.statusID = `orst`.statusID LIMIT $offset, $limit");



        $stm->execute();

        $orders = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $orders;

    }//GetOrders


    public static function getOrderById( $orderID ) {

        // INNER JOIN `creditcards` as `c` ON `c`.userID = `u`.userID

        $stm = MySQL::$db->prepare ("SELECT orst.* , u.* , o.* FROM `orders` as `o` 
                                      INNER JOIN `orderstatuses` as `orst` ON `o`.statusID = `orst`.statusID
                                      INNER JOIN `users` as `u` ON `o`.userID = `u`.userID 
                                      WHERE orderID = :id");

        $stm->bindParam( ":id" , $orderID , \PDO::PARAM_INT);

        $stm->execute();

        $order = $stm->fetch(\PDO::FETCH_OBJ);


        return $order;

    }//getOrderById


     // Удаление

    public static function removeOrder( $orderID ){


        $stm = MySQL::$db->prepare("DELETE FROM orders WHERE  orderID = :id");

        $stm->bindParam(':id' ,  $orderID , \PDO::PARAM_INT);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при удалении заказа!');
        }//if

        return  $result;

    }//removeOrder


    // Обновление табл orderStatuses
    public static function updateOrderStatus( $statusID, $statusTitle) {

        $stm = MySQL::$db->prepare("UPDATE `orderstatuses` SET `statusID` = :id, `statusTitle`= :status WHERE `statusID` = :id");

        $stm->bindParam( ":id" , $statusID , \PDO::PARAM_INT);

        $stm->bindParam( ":status" , $statusTitle, \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при обновлении статуса заказа !');
        }//if

        return  $result;

    }//updateOrderStatus


    // Обновление табл users
    public static function updateUser( $userID, $userName, $userEmail, $userPhone ) {

        $stm = MySQL::$db->prepare("UPDATE `users` SET `userID` = :id, `userName`= :uName, `userEmail`= :uEmail, 
                                    `userPhone`= :uPhone WHERE `userID` = :id");

        $stm->bindParam( ":id" , $userID , \PDO::PARAM_INT);

        $stm->bindParam( ":uName" , $userName, \PDO::PARAM_STR);

        $stm->bindParam( ":uEmail" , $userEmail, \PDO::PARAM_STR);

        $stm->bindParam( ":uPhone" , $userPhone, \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при обновлении Пользователя !');
        }//if

        return  $result;

    }//updateUser


    // Обновление табл orders

    public static function updateOrder( $orderID , $statusID, $dateAndTimeOrder, $deliveryAddressOrder , $commentToTheOrder ,  $userID) {

        $stm = MySQL::$db->prepare("UPDATE `orders` SET `orderID` = :id, `statusID`= :status, `dateAndTimeOrder` = :dateTimeOrder, 
                                    `deliveryAddressOrder`  = :deliveryAddress, `commentToTheOrder` =:comment, `userID` = :userId WHERE `orderID` = :id");


        $stm->bindParam( ":id" , $orderID , \PDO::PARAM_INT);

        $stm->bindParam( ":status" , $statusID, \PDO::PARAM_INT);

        $stm->bindParam( ":dateTimeOrder" , $dateAndTimeOrder, \PDO::PARAM_STR);

        $stm->bindParam( ":deliveryAddress" , $deliveryAddressOrder, \PDO::PARAM_STR);

        $stm->bindParam( ":comment" , $commentToTheOrder, \PDO::PARAM_STR);

        $stm->bindParam( ":userId" , $userID, \PDO::PARAM_STR);


        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при обновлении Заказа !');
        }//if

        return  $result;

    }//updateOrder



    public static function addOrder( $params = array() ){

        $order = new Order(
            $params['statusID'] ,
            $params['address'] ,
            $params['comment'] ,
            $params['userEmail'],
            $params['userName'],
            $params['userPhone']
        );

        /*
         * details:
         * [
         *      {
         *          productID: 12,
         *          productAmount: 2,
         *          productPrice: 100
         *      }
         * ]
         *
         */

        $details = json_decode( $params['details'] );

        foreach ( $details as $detail ){

            $newDetail = new OrderDetails(
                $detail->productID ,
                $detail->productAmount,
                $detail->productPrice ,
                $order->orderID
            );

        }//foreach


        $card = new CreditCard(

            $params['cardNumber'] ,
            $params['name'],
            $params['year'],
            $params['month'],
            $params['securityCode']

        );


        return $order->orderID;

    }//addOrder


}