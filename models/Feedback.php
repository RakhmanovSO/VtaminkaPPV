<?php
/**
 * Created by PhpStorm.
 * User: Hegne
 * Date: 08.09.2018
 * Time: 19:37
 */

namespace models;

use utils\MySQL;

class Feedback
{
    public $feedbackID;
    public $userFullName;
    public $userEmail;
    public $userPhone;
    public $feedbackText;

    public function __construct( $feedbackID, $userFullName, $userEmail, $userPhone, $feedbackText)
    {
        $this->feedbackID = $feedbackID;
        $this->userFullName = $userFullName;
        $this->userEmail = $userEmail;
        $this->userPhone = $userPhone;
        $this->feedbackText = $feedbackText;
    }//__construct

    public static function GetFeedbackList( $limit = 5, $offset= 0 )
    {
        $stm = MySQL::$db->prepare("SELECT * FROM feedback LIMIT $offset,$limit");

        $stm->execute();

        $feedbackList = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $feedbackList;
    }//GetFeedbackList

    public static function AddFeedback( $userFullName, $userEmail, $userPhone, $feedbackText )
    {
        $stm = MySQL::$db->prepare
        (
            "INSERT INTO feedback(feedbackID, userFullName, userEmail, userPhone, feedbackText)
             VALUES(NULL, :fullName, :email, :phone, :text)"
        );

        $stm->bindParam(':fullName', $userFullName, \PDO::PARAM_STR);
        $stm->bindParam(':email', $userEmail, \PDO::PARAM_STR);
        $stm->bindParam(':phone', $userPhone, \PDO::PARAM_STR);
        $stm->bindParam(':text', $feedbackText, \PDO::PARAM_STR);

        $result = $stm->execute();

        if($result === false)
        {
            throw new \Exception('Ошибка добавления отзыва!');
        }//if

        return $result;
    }//AddFeedback

    public static function RemoveFeedback( $feedbackID )
    {
        $stm = MySQL::$db->prepare("DELETE FROM feedback WHERE feedbackID = :id");

        $stm->bindParam(':id', $feedbackID, \PDO::PARAM_INT);

        $result = $stm->execute();

        if($result === false)
        {
            throw new \Exception('Ошибка при удалении отзыва!');
        }//if

        return result;
    }//RemoveFeedback

}//Feedback