<?php
/**
 * Created by PhpStorm.
 * User: Ilai
 * Date: 05.09.2018
 * Time: 17:27
 */

namespace controllers;

use models\Constant;

class ConstantsController extends BaseController
{
    public function constListAction(  )
    {

        $this->view->constants = Constant::GetConstants(10,0);

        return 'constants-list';

    }

    public function addConstAction(  )
    {
        return 'addNewConst';
    }

    public function addNewConstAction(  ){

        $constTitle = $this->request->getPostValue('constTitle');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{
            $result = Constant::AddConstant( $constTitle );

            $response['code'] = 200;
            $response['message'] = 'Категория добавлена!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'constTitle' => $constTitle,
            );

        }//catch

        $this->json( $response );

    }

    public function removeConstAction()
    {

        $constID = $this->request->getDeleteValue('constID');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{

            $result = Constant::removeConstant( $constID );

            $response['code'] = 200;
            $response['message'] = 'Константа удалена!';
            $response['data'] = $result;

        }
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'constID' => $constID,
            );

        }

        $this->json($response);

    }

}