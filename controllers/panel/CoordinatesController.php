<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 019 19.09.18
 * Time: 0:21
 */

namespace controllers\panel;


use models\Coordinates;
use utils\MySQL;

class CoordinatesController extends BaseController
{
    public function coordinatesListAction(  ){

        $this->view->coords = Coordinates::GetCoordinates();
        return 'coordinates-list';

    }//coordinatesListAction


    public function addNewCoordinatesAction(  ){

        $latitude = $this->request->getPostValue('latitude');
        $longitude = $this->request->getPostValue('longitude');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{

            Coordinates::AddCoordinates( $latitude, $longitude );

            $response['code'] = 200;
            $response['message'] = 'Координаты добавлены!';
            $response['data'] = null;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'latitude' => $latitude,
                'longitude' => $longitude,
            );

        }//catch

        $this->json( $response );

    }//addNewCoordinatesAction


}