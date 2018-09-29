<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 018 18.09.18
 * Time: 23:08
 */

namespace models;

use utils\MySQL;

class Coordinates
{
    public $latitude;
    public $longitude;

    public function __construct($latitude,  $longitude){

        $this->latitude = $latitude;
        $this->longitude = $longitude;

    }//__construct

    public static function AddCoordinates( $latitude,  $longitude){

            $f = fopen('coords.json', 'w');
            fwrite($f , json_encode(array(
                'lat' => $latitude,
                'lng' => $longitude
            )));

            fclose($f);

    }//AddCoordinates

    public static function GetCoordinates(  ){


        $f = fopen('coords.json', 'r');
        $coordsString = fgets($f);

        $coordsJson = json_decode($coordsString);

        fclose($f);

        return $coordsJson;

    }//GetCoordinates

}//Coordinates