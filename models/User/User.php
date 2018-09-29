<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 16.09.2018
 * Time: 12:07
 */

namespace models\user;

use utils\MySQL;
/* - Пользователь
    * Номер
    * Email
    * Имя
    * Телефон
*/

class User{

    public $userID;
    public $userName;
    public $userEmail;
    public $userPhone;


    public function __construct( $userName , $userEmail, $userPhone ){

        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->userPhone = $userPhone;

        $stm = MySQL::$db->prepare("INSERT INTO users (userID, userName, userEmail, userPhone) 
                                      VALUES (NULL, :name, :email, :phone)");
        $stm->bindParam(':name' , $userName , \PDO::PARAM_STR);
        $stm->bindParam(':email' , $userEmail , \PDO::PARAM_STR);
        $stm->bindParam(':phone' , $userPhone , \PDO::PARAM_STR);
        $result = $stm->execute();

        $this->userID = MySQL::$db->lastInsertId();

        return $result;

    }//__construct


    public static function GetUsers( $limit = 10 , $offset = 0)
    {
        $stm = MySQL::$db->prepare("SELECT * FROM `users` LIMIT $offset,$limit");
        $stm->execute();
        $users = $stm->fetchAll(\PDO::FETCH_OBJ);
        return $users;
    }

    public static function removeUser( $userID )
    {
        $stm = MySQL::$db->prepare("DELETE FROM users WHERE userID = :id");
        $stm->bindParam(':id' , $userID , \PDO::PARAM_INT);
        $result = $stm->execute();
        if( $result === false )
            throw new \Exception('Ошибка при удалении пользователя!');
        return  $result;
    }

    public static function updateUser( $userID , $userName, $userEmail, $userPhone )
    {
        $stm = MySQL::$db->prepare("UPDATE users 
                                        SET userName = :name, userEmail = :email, userPhone = :phone
                                        WHERE `userID` = :id");
        $stm->bindParam( ":id" , $userID , \PDO::PARAM_INT);
        $stm->bindParam(':name' , $userName , \PDO::PARAM_STR);
        $stm->bindParam(':email' , $userEmail , \PDO::PARAM_STR);
        $stm->bindParam(':phone' , $userPhone , \PDO::PARAM_STR);
        $result = $stm->execute();
        if( $result === false )
            throw new \Exception('Ошибка при обновлении пользователя!');
        return  $result;
    }

    public static function getUserByEmail( $userEmail ){

        $stm = MySQL::$db->prepare("SELECT * FROM `users` WHERE userEmail = :email");

        $stm->bindParam(':email' , $userEmail , \PDO::PARAM_STR);

        $stm->execute();
        $user = $stm->fetch(\PDO::FETCH_OBJ);
        return $user;

    }

}