<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 26.08.2018
 * Time: 11:32
 */

namespace models;

use Utils\MySQL;

class ProductAttribute{

    public $attributeID;
    public $attributeTitle;

    public function __construct( $attributeID , $attributeTitle){
        $this->attributeID = $attributeID;
        $this->attributeTitle = $attributeTitle;
    }

    public static function getAttributesList( $limit = 10 , $offset = 0 ){

        $stm = MySQL::$db->prepare("SELECT * FROM productattributes LIMIT $offset,$limit");

        $stm->execute();

        $categories = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $categories;


    }

    public static function addNewAttribute( $attributeTitle ){

        $stm = MySQL::$db->prepare("INSERT INTO productattributes( attributeID , attributeTitle) VALUES(NULL , :title)");

        $stm->bindParam(':title' , $attributeTitle , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false ){
            throw new \Exception('Ошибка добавления атрибута! Возможно такой атрибут уже есть!');
        }//if

        return  $result;


    }//addNewAttribute

}