<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 16.09.2018
 * Time: 11:32
 */

namespace models\order;

use utils\MySQL;

class OrderStatus{

    public $statusID;
    public $statusTitle;


    public static function AddNewStatus( $statusTitle ){

        $stm = MySQL::$db->prepare("
            INSERT INTO orderstatuses( statusID , statusTitle )
            VALUES(DEFAULT, :title )
        ");

        $stm->bindParam(":title" , $statusTitle , \PDO::PARAM_STR);

        $result = $stm->execute();

        return $result;

    }//AddNewStatus

    public static function GetOrderStatusesList( $limit = 10 , $offset = 0){

        $stm = MySQL::$db->prepare("
            SELECT * FROM orderstatuses
            LIMIT $limit,$offset
        ");

        $stm->execute();

        $statuses = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $statuses;

    }//GetOrderStatusesList

}//OrderStatus

