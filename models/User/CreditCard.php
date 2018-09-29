<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 23.09.2018
 * Time: 10:23
 */

namespace models\user;

use utils\MySQL;


class CreditCard
{
    public $cardID;
    public $cardNumber;
    public $name;
    public $year;
    public $month;
    public $securityCode;

    public function __construct($cardNumber, $name, $year , $month, $securityCode){
        $this->cardNumber = $cardNumber;
        $this->name = $name;
        $this->year = $year;
        $this->month = $month;
        $this->securityCode = $securityCode;

        $stm = MySQL::$db->prepare("INSERT INTO `creditcards` (`cardID`, `cardNumber`, `name`, `year`, `month`, `securityCode`) 
                                      VALUES (NULL, ':cardNumber', ':name', ':year', ':month', ':securityCode')");
        $stm->bindParam(":cardNumber" , $cardNumber , \PDO::PARAM_STR);
        $stm->bindParam(":name" , $name , \PDO::PARAM_STR);
        $stm->bindParam(":year" , $year , \PDO::PARAM_INT);
        $stm->bindParam(":month" , $month , \PDO::PARAM_INT);
        $stm->bindParam(":securityCode" , $securityCode , \PDO::PARAM_INT);
        $result = $stm->execute();

        $this->cardID = MySQL::$db->lastInsertId();

        return $result;

    }

    public static function GetCreditCards( $limit = 10 , $offset = 0)
    {
        $stm = MySQL::$db->prepare("SELECT * FROM `creditcards` LIMIT $offset,$limit");
        $stm->execute();
        $creditcards = $stm->fetchAll(\PDO::FETCH_OBJ);
        return $creditcards;
    }

    public static function removeCreditCard( $cardID )
    {
        $stm = MySQL::$db->prepare("DELETE FROM `creditcards` WHERE `creditcards.cardID` = :id");
        $stm->bindParam(':id' , $cardID , \PDO::PARAM_INT);
        $result = $stm->execute();
        if( $result === false )
            throw new \Exception('Ошибка при удалении кредитной карты!');
        return  $result;
    }
}