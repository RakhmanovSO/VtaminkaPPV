<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 10:17
 */

namespace controllers;
use utils\MySQL;


class MainController extends BaseController {

    public function start(  ){

        $controller = $this->request->getGetValue('ctrl');
        $action = $this->request->getGetValue('act');

        try{
            MySQL::$db = new \PDO(
                "mysql:host=localhost;dbname=vtaminka;charset=utf8",
                'root',
                ''
            );
        }//try
        catch( \PDOException $ex ){
            die( "DATABASE CONNECTION ERROR! {$ex->getMessage()}" );
        }//catch

        $controllerClass = "controllers\\{$controller}Controller";

        $controllerInstance = new $controllerClass();

        $viewToInclude = $controllerInstance->{"{$action}Action"}();

        $this->view = $controllerInstance->view;


        include_once "views/Default/header.php";

        include_once "views/$controller/$viewToInclude.php";

        //include_once "views/Default/footer.php";

    }//start


}