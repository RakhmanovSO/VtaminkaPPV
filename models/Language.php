<?php
/**
 * Created by PhpStorm.
 * User: Ilai
 * Date: 05.09.2018
 * Time: 16:00
 */

namespace models;

use utils\MySQL;

class Language
{
    public $langID;
    public $langTag;

    public function __construct( $langID , $langTag)
    {
        $this->$langID = $langID;
        $this->$langTag = $langTag;
    }

    public static function GetLanguages( $limit = 10 , $offset = 0)
    {
        $stm = MySQL::$db->prepare("SELECT * FROM `language` LIMIT $offset,$limit");

        $stm->execute();

        $languages = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $languages;
    }

    public static function AddLanguage( $langTag )
    {
        $stm = MySQL::$db->prepare("INSERT INTO `language` (`langID`, `langTag`) VALUES(NULL , :tag)");

        $stm->bindParam(':tag' , $langTag , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка добавления языка! Возможно такой язык уже добавлен!');

        return  $result;
    }

    public static function removeLanguage( $langID )
    {
        $stm = MySQL::$db->prepare("DELETE FROM `language` WHERE `language`.`langID` = :id");

        $stm->bindParam(':id' , $langID , \PDO::PARAM_INT);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка при удалении языка!');

        return  $result;
    }

    public static function updateLanguage( $langID , $langTag )
    {
        $stm = MySQL::$db->prepare("UPDATE `language` SET `langTag` = :tag WHERE `language`.`langID` = :id");
        $stm->bindParam( ":id" , $langID , \PDO::PARAM_INT);
        $stm->bindParam( ":tag" , $langTag , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка при обновлении языка!');

        return  $result;
    }
}