<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 10:27
 */

namespace utils;


class Request{

    //$_GET
    public function getGetValue( $name ){

        if( isset($_GET[$name]) ){
            return filter_input(INPUT_GET , $name , FILTER_SANITIZE_STRING);
        }//if

        return null;

    }//getGetValue

    //$_POST
    public function getPostValue( $name ){

        if( isset($_POST[$name]) ){
            return filter_input(INPUT_POST, $name , FILTER_SANITIZE_STRING);
        }//if

        return null;

    }

    //$_REQUEST
    public function getRequestValue( $name ){

        if( isset($_REQUEST[$name]) ){
            return filter_input(INPUT_REQUEST, $name , FILTER_SANITIZE_STRING);
        }//if

        return null;

    }

    //$_DELETE
    public function getDeleteValue( $name ){

        $post_vars = array();

        parse_str(file_get_contents("php://input"),$post_vars);

        if( isset($post_vars[$name]) ){
            return $post_vars[$name];
        }//if

        return null;

    }

}