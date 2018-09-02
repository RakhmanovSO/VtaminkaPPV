<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 26.08.2018
 * Time: 12:06
 */

namespace models;

use utils\MySQL;

class Product{

    public static function getProductsList( $limit = 10, $offset = 0 ){

        $stm = MySQL::$db->prepare("SELECT * FROM products LIMIT $offset,$limit");

        $stm->execute();

        $products = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $products;

    }//getProductsList

}//Product