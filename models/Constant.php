<?php
/**
 * Created by PhpStorm.
 * User: Ilai
 * Date: 05.09.2018
 * Time: 17:28
 */

namespace models;

use utils\MySQL;

class Constant
{
    public $constantID;
    public $constantTitle;

    public function __construct( $constantID , $constantTitle)
    {
        $this->$constantID = $constantID;
        $this->$constantTitle = $constantTitle;
    }

    public static function GetConstants( $limit = 10 , $offset = 0)
    {
        $stm = MySQL::$db->prepare("SELECT * FROM constants LIMIT $offset,$limit");

        $stm->execute();

        $constants = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $constants;
    }

    public static function AddConstant( $constTitle )
    {
        $stm = MySQL::$db->prepare("INSERT INTO `constants` (`constantID`, `constantTitle`) VALUES(NULL , :title)");

        $stm->bindParam(':title' , $constTitle , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка добавления константы!');

        return  $result;
    }

    public static function removeConstant( $constID )
    {
        $stm = MySQL::$db->prepare("DELETE FROM `constants` WHERE constantID = :id");

        $stm->bindParam(':id' , $constID , \PDO::PARAM_INT);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка при удалении константы!');

        return  $result;
    }

    public static function updateConstant( $constID , $constTitle )
    {
        $stm = MySQL::$db->prepare("UPDATE `constants` SET `constantTitle` = :title WHERE `constants`.`constantID` = :id");
        $stm->bindParam( ":id" , $constID , \PDO::PARAM_INT);
        $stm->bindParam( ":title" , $constTitle , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка при обновлении константы!');

        return  $result;
    }
}