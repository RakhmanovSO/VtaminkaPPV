<?php
/**
 * Created by PhpStorm.
 * User: Ilai
 * Date: 05.09.2018
 * Time: 18:31
 */

namespace models;

use utils\MySQL;

class Translation
{
    public $translationID;
    public $translationTag;
    public $translationConst;
    public $translationsText;

    public function __construct( $translationID , $translationTag, $translationConst, $translationsText )
    {
        $this->$translationID = $translationID;
        $this->$translationTag = $translationTag;
        $this->$translationConst = $translationConst;
        $this->$translationsText = $translationsText;
    }

    public static function GetTranslations( $limit = 10 , $offset = 0)
    {
        $stm = MySQL::$db->prepare("SELECT * FROM translations LIMIT $offset,$limit");

        $stm->execute();

        $translations = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $translations;
    }

    public static function AddTranslations($langID, $constID, $transText )
    {
        $stm = MySQL::$db->prepare("INSERT INTO `translations` (`translationID`, `translationTag`, `translationConst`, `translationsText`) VALUES (NULL, :langID, :constID, :transText)");

        $stm->bindParam(':langID' , $langID , \PDO::PARAM_INT);
        $stm->bindParam(':constID' , $constID , \PDO::PARAM_INT);
        $stm->bindParam(':transText' , $transText , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка добавления перевода!');

        return  $result;
    }

    public static function removeTranslations( $transID )
    {
        $stm = MySQL::$db->prepare("DELETE FROM `translations` WHERE `translations`.`translationID` = :id");

        $stm->bindParam(':id' , $transID , \PDO::PARAM_INT);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка при удалении перевода!');

        return  $result;
    }

    public static function updateTranslations( $transID , $transText )
    {
        $stm = MySQL::$db->prepare("UPDATE `translations` SET `translationsText` = :text WHERE  WHERE `translations`.`translationID` = :id");
        $stm->bindParam( ":id" , $transID , \PDO::PARAM_INT);
        $stm->bindParam( ":text" , $transText , \PDO::PARAM_STR);

        $result = $stm->execute();

        if( $result === false )
            throw new \Exception('Ошибка при обновлении перевода!');

        return  $result;
    }
}