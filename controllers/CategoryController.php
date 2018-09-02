<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 12:21
 */

namespace controllers;

use models\Category;

class CategoryController extends BaseController{

    public function categoriesListAction(  ){

        $this->view->categories = Category::GetCategories(10,0);

        return 'categories-list';

    }//categoriesListAction

    public function addCategoryAction(  ){
        return 'addNewCategory';
    }

    public function addNewCategoryAction(  ){

        $categoryTitle = $this->request->getPostValue('categoryTitle');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{
            $result = Category::AddCategory( $categoryTitle );

            $response['code'] = 200;
            $response['message'] = 'Категория добавлена!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'categoryTitle' => $categoryTitle,
            );

        }//catch

        $this->json( $response );

    }

    public function removeCategoryAction(){

        $categoryID = $this->request->getDeleteValue('categoryID');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{

            $result = Category::removeCategory( $categoryID );

            $response['code'] = 200;
            $response['message'] = 'Категория удалена!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'categoryTitle' => $categoryID,
            );

        }//catch

        $this->json($response);

    }//removeCategoryAction

}