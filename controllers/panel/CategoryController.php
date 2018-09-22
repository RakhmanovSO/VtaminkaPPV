<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 12:21
 */

namespace controllers\panel;

use models\Category;

class CategoryController extends BaseController{

    public function categoriesListAction(  ){

        $this->view->categories = Category::GetCategories(10,0);

        foreach ( $this->view->categories as $category ){
            $category->count = Category::GetProductsAmountByCategory( $category->categoryID );
        }

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

    public function categoryAndProductsAction(  ){

        $categoryID = $this->request->getGetValue( 'categoryID' );

        $this->view->category = Category::getCategoryById(  $categoryID );

        $this->view->products = Category::GetCategoryAndProducts($categoryID , 10,0);

        return 'categoryAndProducts';

    }//categoriesListAction

    public function updateCategoryAction(){

          $categoryID = $this->request->getGetValue('categoryID');
          $category = Category::getCategoryById( $categoryID );

          $this->view->category =$category;
          return 'updateCategory';

    }//updateCategory

    public function saveCategoryAction(  ){

        $categoryID = $this->request->getPostValue('categoryID');
        $categoryTitle = $this->request->getPostValue('categoryTitle');
        $response = array(
            'code' => -1,
            'message' => '',
            'data' => ''
        );

        try{

            Category::updateCategory( $categoryID , $categoryTitle );

            $response['code'] = 200;
            $response['message'] = 'Категория обновлена успешно!';

        }//try
        catch( \Exception $ex ){

            $response['code'] = 500;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'categoryID' => $categoryID,
                'categoryTitle' => $categoryTitle,
            );

        }//catch

        $this->json( $response );

    }//saveCategoryAction

}