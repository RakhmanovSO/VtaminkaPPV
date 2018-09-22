<?php
/**
 * Created by PhpStorm.
 * User: Ilai
 * Date: 04.09.2018
 * Time: 17:19
 */

namespace controllers;

use models\Language;

class LanguagesController extends BaseController
{
    public function langListAction(  )
    {

        $this->view->languages =  Language::GetLanguages(10,0);

        return 'languages-list';

    }

    public function addLanguagesAction(  )
    {
        return 'addNewLanguages';
    }

    public function addNewLanguagesAction(  )
    {

        $langTag = $this->request->getPostValue('langTag');

        $response = array
        (
            'code' => '' ,
            'data' => '' ,
            'message' => ''
        );

        try
        {
            $result = Language::AddLanguage( $langTag );

            $response['code'] = 200;
            $response['message'] = 'Язык добавлен!';
            $response['data'] = $result;

        }
        catch( \Exception $ex )
        {

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'langTag' => $langTag,
            );
        }

        $this->json( $response );
    }

    public function removeLanguageAction()
    {

        $langID = $this->request->getDeleteValue('langID');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try
        {
            $result = Language::removeLanguage( $langID );

            $response['code'] = 200;
            $response['message'] = 'Язык удален!';
            $response['data'] = $result;
        }
        catch( \Exception $ex )
        {
            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'langID' => $langID,
            );
        }

        $this->json($response);
    }
}