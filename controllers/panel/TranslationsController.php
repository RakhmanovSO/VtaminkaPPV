<?php
/**
 * Created by PhpStorm.
 * User: Ilai
 * Date: 05.09.2018
 * Time: 18:31
 */

namespace controllers\panel;

use models\Translation;
use models\Constant;
use models\Language;
use utils\MySQL;

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
        $langID = $this->request->getPostValue('langID');
        $constantID = $this->request->getPostValue('constantID');
        $Text = $this->request->getPostValue('Text');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try
        {
            $result = Translation::AddTranslations(
                $langID,
                $constantID,
                $Text );


            $lastID = MySQL::$db->lastInsertId();

            $response['code'] = 200;
            $response['message'] = 'Перевод добавлен!';
            $response['data'] = array(
                'translationID' => $lastID
            );

        }//try
        catch( \Exception $ex )
        {

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'langID' => $langID,
                'constantID' => $constantID,
                'Text' => $Text,
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