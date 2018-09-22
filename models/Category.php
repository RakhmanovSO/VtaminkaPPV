<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 12:14
 */

namespace models;

use utils\MySQL;

class Category{

    public $categoryID;
    public $categoryTitle;

    public function __construct( $categoryID , $categoryTitle){

        $this->categoryID = $categoryID;
        $this->categoryTitle = $categoryTitle;

    }//__construct

    public static function GetCategories( $limit = 10 , $offset = 0){

        $stm = MySQL::$db->prepare("SELECT * FROM categories LIMIT $offset,$limit");

        $stm->execute();

        $categories = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $categories;

    }

    public static function AddCategory( $categoryTitle ){

        $stm = MySQL::$db->prepare("INSERT INTO categories(categoryID , categoryTitle) VALUES(NULL , :title)");

        $stm->bindParam(':title' , $categoryTitle , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка добавления категории! Возможно такая категория уже есть!');
        }//if

        return  $result;

    }

    public static function removeCategory( $categoryID ){


        $stm = MySQL::$db->prepare("DELETE FROM categories WHERE categoryID = :id");

        $stm->bindParam(':id' , $categoryID , \PDO::PARAM_INT);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при удалении категории!');
        }//if

        return  $result;


    }

    public static function getCategoryById( $categoryID ) {

        $stm = MySQL::$db->prepare("SELECT * FROM categories WHERE categoryID = :id");
        $stm->bindParam( ":id" , $categoryID , \PDO::PARAM_INT);

        $stm->execute();

        $category = $stm->fetch(\PDO::FETCH_OBJ);

        return $category;

    }//getCategoryById


    public static function GetCategoryAndProducts( $categoryID ,  $limit = 10 , $offset = 0){

        $stm = MySQL::$db->prepare("
                    SELECT p.productID , p.productTitle , p.productPrice 
                    FROM `productandcategories` as `pc` 
                    INNER JOIN `products` as `p` 
                      ON `p`.productID = `pc`.productID 
                    WHERE pc.`categoryID` = :id LIMIT $offset,$limit");

        $stm->bindParam(':id' , $categoryID , \PDO::PARAM_INT);

        $stm->execute();

        $categoriesandproducts = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $categoriesandproducts;

    }//GetCategoryAndProducts

    public static function GetProductsAmountByCategory(  $categoryID ){

        $stm = MySQL::$db->prepare("SELECT COUNT(pc.productID) as `count` FROM `productandcategories` as pc WHERE pc.categoryID = :id");

        $stm->bindParam(':id' , $categoryID , \PDO::PARAM_INT);

        $stm->execute();

        $count = $stm->fetch(\PDO::FETCH_OBJ);

        return $count->count;


    }//GetProductsAmountByCategory

    public static function updateCategory( $categoryID , $categoryTitle ) {

        $stm = MySQL::$db->prepare("UPDATE `categories` SET `categoryTitle`= :title WHERE `categoryID` = :id");
        $stm->bindParam( ":id" , $categoryID , \PDO::PARAM_INT);
        $stm->bindParam( ":title" , $categoryTitle , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка при обновлении категории!');
        }//if

        return  $result;

    }//getCategoryById
}

