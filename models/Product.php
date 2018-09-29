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



    public static function AddProduct( $productTitle,  $productDescription, $productPrice ) {

        $stm = MySQL::$db->prepare("INSERT INTO products(productID , productTitle, productDescription, productPrice) VALUES (NULL ,:title , :description , :price )");

        $stm->bindParam(':title', $productTitle, \PDO::PARAM_STR);


        $stm->bindParam(':description', $productDescription, \PDO::PARAM_STR);


        $stm->bindParam(':price', $productPrice, \PDO::PARAM_STR);




        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка добавления Продукта! Возможно такой Продукт уже есть!');
        }//if

        return  $result;

    }//AddProduct

    public static function getProductById( $productID ) {

        $stm = MySQL::$db->prepare("SELECT * FROM products WHERE productID = :id");
        $stm->bindParam( ":id" , $productID , \PDO::PARAM_INT);

        $stm->execute();

        $products = $stm->fetch(\PDO::FETCH_OBJ);

        return $products;

    }//getProductById

    public static function GetAllProducts( $productID ,  $limit = 10 , $offset = 0){

        $stm = MySQL::$db->prepare("
                    SELECT p.productID , p.productTitle , p.productPrice 
                    FROM `products` as `pc`  
                    WHERE pc.`productID` = :id LIMIT $offset,$limit");

        $stm->bindParam(':id' , $productID , \PDO::PARAM_INT);

        $stm->execute();

        $products = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $products;

    }//GetAllProducts

}//Product