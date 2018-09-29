<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 26.08.2018
 * Time: 11:38
 */

namespace controllers\panel;

use models\Category;
use models\Product;
use models\ProductAndAttributes;
use models\ProductAndCategory;
use models\ProductAttribute;
use utils\MySQL;

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


    public function addNewProductAction(  ){

        $productTitle = $this->request->getPostValue('productTitle');

        $productDescription = $this->request->getPostValue('productDescription');

        $productPrice = $this->request->getPostValue('productPrice');

        $attributes = json_decode(  $_POST['attributes'] );


        $categories = json_decode(  $_POST['categories'] );


        $response = array(
            'code' => '' , 'data' => '' , 'message' => ''
        );

        try{
            $result = Product::AddProduct( $productTitle, $productDescription , $productPrice);
            $productID = MySQL::$db->lastInsertId();

            foreach ( $attributes as $attribute ){

                ProductAndAttributes::AddAttributeToProduct($productID , $attribute->attributeID , $attribute->attributeValue );

            }//foreach


            foreach ( $categories as $category ){

                ProductAndCategory::AddCategoryToProduct($productID , $category );

            }//foreach


            $response['code'] = 200;
            $response['message'] = 'Продукт добавлен!';
            $response['data'] = $result;

        }//try
        catch( \Exception $ex ){

            $response['code'] = 400;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'productTitle' => $productTitle,
                'productDescription' => $productDescription,
                'productPrice' => $productPrice

            );

        }//catch

        $this->json( $response );

    }//addNewProductAction

    public function allProductsAction(  ){

        $productID = $this->request->getGetValue( 'productID' );

        $this->view->products = Product::getProductById(  $productID );

        $this->view->products = Product::GetAllProducts($productID , 10,0);

        return 'allProducts';

    }//allProductsAction

}//ProductController