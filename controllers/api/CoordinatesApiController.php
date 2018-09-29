<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 018 18.09.18
 * Time: 23:05
 */

namespace controllers\api;


use models\Coordinates;
use controllers\panel\BaseController;

class CoordinatesApiController extends BaseController
{
    public function GetCoordinatesAction (){

        $response = array(

            'code' => 0,

            'message' => 0,

            'data' => 0

        );

        $coords = Coordinates::GetCoordinates();

        $response['code'] = 200;

        $response['data'] = $coords;

        $this->json( $response );

    }//GetProductsList
}