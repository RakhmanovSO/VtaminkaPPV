<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 09.09.2018
 * Time: 11:47
 */

namespace controllers\api;

use models\Category;
use controllers\panel\BaseController;

class CategoryApiController extends BaseController {

    //API-метод получения списка товаров по заданной категори
    //GET-метод
    //@categoryID
    //@limit  = 10
    //@offset = 0

    public function GetProductsByCategoryAction(  ){

        $response = array(
            'code' => 0,
            'message' => 0,
            'data' => 0
        );

        $categoryID = $this->request->getGetValue('categoryID');
        $limit = $this->request->getGetValue('limit');
        $offset = $this->request->getGetValue('offset');

        if(empty($limit) || $limit < 1){
            $limit = 10;
        }//if

        if(empty($offset) || $offset < 1 ){
            $offset = 0;
        }//if

        $products = Category::GetCategoryAndProducts($categoryID,$limit , $offset);

        $category = Category::getCategoryById($categoryID);

        $response['code'] = 200;
        $response['data'] = array(
            'products' => $products,
            'category' => $category,
        );

        $this->json( $response );

    }//GetProductsByCategoryAction

}