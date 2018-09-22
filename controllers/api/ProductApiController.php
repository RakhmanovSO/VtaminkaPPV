<?php
/**
 * Created by PhpStorm.
 * User: Vladi
 * Date: 15.09.2018
 * Time: 21:49
 */

namespace controllers\api;

use models\Product;
use controllers\panel\BaseController;

class ProductApiController extends BaseController{

    public function GetProductsListAction (){

        $response = array(

            'code' => 0,

            'message' => 0,

            'data' => 0

        );

        $limit = $this->request->getGetValue('limit');

        $offset = $this->request->getGetValue('offset');

        if(empty($limit) || $limit < 1){

            $limit = 10;

        }//if



        if(empty($offset) || $offset < 1 ){

            $offset = 0;

        }//if

        $products = Product::getProductsList($limit , $offset);

        $response['code'] = 200;

        $response['data'] = $products;

        $this->json( $response );

    }//GetProductsList

}