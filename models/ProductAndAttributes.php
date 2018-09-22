<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 09.09.2018
 * Time: 9:16
 */

namespace models;

use utils\MySQL;

class ProductAndAttributes{

    public static function AddAttributeToProduct( $productID , $attributeID , $value ){

        $stm = MySQL::$db->prepare("INSERT INTO productandattributes( ID , attributeID , productID , value ) VALUES(NULL , :attributeID , :productID , :value )");

        $stm->bindParam(':attributeID' , $attributeID , \PDO::PARAM_INT);
        $stm->bindParam(':productID' , $productID , \PDO::PARAM_INT);
        $stm->bindParam(':value' , $value , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка добавления атрибута!');
        }//if

        return  $result;

    }//AddAttributeToProduct

}//ProductAndAttributes