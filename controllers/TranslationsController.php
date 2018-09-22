<?php
/**
 * Created by PhpStorm.
 * User: Ilai
 * Date: 05.09.2018
 * Time: 18:31
 */

namespace controllers;

use models\Translation;
use models\Constant;
use models\Language;

class TranslationsController extends BaseController
{
    public function translateListAction(  )
    {
        $this->view->languages =  Language::GetLanguages(10,0);
        $this->view->constants = Constant::GetConstants(10,0);
        $this->view->translations = Translation::GetTranslations(10,0);

        return 'translations-list';

    }

    public function addTranslateAction(  )
    {
        return 'addNewTranslate';
    }

    public function addNewTranslateAction(  )
    {
        $json = $this->request->getPostValue('newTranslate');

        $newTranslate = json_decode($json);

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try
        {
            $result = Translation::AddTranslations( $newTranslate->{'langID'}, $newTranslate->{'constantID'}, $newTranslate->{'Text'} );

            $response['code'] = 200;
            $response['message'] = 'Перевод добавлен!';
            $response['data'] = $result;
        }
        catch( \Exception $ex )
        {

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'newTranslate' => $newTranslate,
            );
        }

        $this->json( $response );

    }

    public function removeTranslateAction()
    {

        $transID = $this->request->getDeleteValue('transID');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{

            $result = Translation::removeTranslations( $transID );

            $response['code'] = 200;
            $response['message'] = 'Перевод удален!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'transID' => $transID,
            );

        }//catch

        $this->json($response);

    }

}