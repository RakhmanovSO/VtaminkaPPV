<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 26.08.2018
 * Time: 11:38
 */

namespace controllers;

use models\Category;
use models\Product;
use models\ProductAttribute;

class ProductController extends BaseController {

    public function productsListAction(  ){
        
        $this->view->products = Product::getProductsList();
        return 'products-list';

    }//productsListAction

    public function addProductAction(  ){

        $this->view->categories = Category::GetCategories();
        $this->view->attributes = ProductAttribute::getAttributesList();

        return 'addProduct';

    }//addProductAction

    public function attributesListAction(  ){

        $this->view->attributes = ProductAttribute::getAttributesList();

        return 'attributes-list';

    }//attributesListAction

    public function addAttributeAction(  ){
        return 'addAttribute';
    }//addAttributeAction


    //AJAX
    public function addNewAttributeAction(  ){

        $attributeTitle = $this->request->getPostValue('attributeTitle');

        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{
            $result = ProductAttribute::addNewAttribute( $attributeTitle );

            $response['code'] = 200;
            $response['message'] = 'Атрибут добавлен!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'attributeTitle' => $attributeTitle,
            );

        }//catch

        $this->json( $response );

    }//addNewAttributeAction

}//ProductController