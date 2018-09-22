<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 09.09.2018
 * Time: 9:16
 */

namespace models;

use utils\MySQL;

class ProductAndCategory{

    public static function AddCategoryToProduct( $productID , $categoryID ){

        $stm = MySQL::$db->prepare("INSERT INTO productandcategories( ID , productID, categoryID  ) VALUES( NULL ,:productID, :categoryID  )");

        $stm->bindParam(':productID' , $productID , \PDO::PARAM_INT);
        $stm->bindParam(':categoryID' , $categoryID , \PDO::PARAM_INT);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка добавления Категории!');
        }//if

        return  $result;

    }//AddAttributeToProduct

}//ProductAndAttributes