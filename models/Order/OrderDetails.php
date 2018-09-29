<?php

namespace models\order;

use utils\MySQL;



class OrderDetails
{

    public $orderDetailsID;
    public $productID;
    public $amountProduct;
    public $productPrice;


    public function __construct($productID, $amountProduct, $productPrice , $orderID)
    {

        $stm = MySQL::$db->prepare("
                  INSERT INTO `orderdetails`
                  (`orderDetailsID`,`productID`,`amountProduct`,`productPrice` , `orderID`)
                  VALUES(DEFAULT , :productId, :amount, :price , :id) 
         ");

        $stm->bindParam( ":id" , $orderID , \PDO::PARAM_INT);

        $stm->bindParam( ":productId" , $productID, \PDO::PARAM_INT);

        $stm->bindParam( ":amount" , $amountProduct, \PDO::PARAM_INT);

        $stm->bindParam( ":price" , $productPrice, \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при обновлении деталей заказа !');
        }//if

        $this->orderDetailsID = MySQL::$db->lastInsertId();

        return  $result;


    }


    // Обновление  orderDetails

    public static function  updateOrderDetails ($productID, $amountProduct, $productPrice , $orderID){


        $stm = MySQL::$db->prepare("UPDATE `orderdetails` SET `productID`= :productId, `amountProduct`= :amount, 
                                    `productPrice`= :price WHERE `orderID` = :id");

        $stm->bindParam( ":id" , $orderID , \PDO::PARAM_INT);

        $stm->bindParam( ":productId" , $productID, \PDO::PARAM_INT);

        $stm->bindParam( ":amount" , $amountProduct, \PDO::PARAM_STR);

        $stm->bindParam( ":price" , $productPrice, \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при обновлении деталей заказа !');
        }//if

        return  $result;


    }//updateOrderDetails


    public static function getDetailsByOrder( $orderID ){


        $stmt = MySQL::$db->prepare( "
            SELECT 
              od.orderDetailsID as orderDetailsID,
              od.productID as id,
              od.amountProduct as amount,
              od.productPrice as price,
              p.productTitle as title
            FROM orderdetails as od
            INNER JOIN products as p
                ON p.productID = od.productID
            WHERE od.orderID = :id 
        " );


        $stmt->bindValue(':id' , $orderID , \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);

    }


    // Удаление из orderDetails

    public static function removeOrderDetails( $orderDetailsID ){


        $stm = MySQL::$db->prepare("DELETE FROM `orderdetails` WHERE orderDetailsID = :id");

        $stm->bindParam(':id' , $orderDetailsID , \PDO::PARAM_INT);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при удалении из OrderDetails !');
        }//if

        return  $result;


    }//removeOrderDetails


}