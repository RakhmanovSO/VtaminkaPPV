<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 10:17
 */

namespace controllers\panel;
use utils\MySQL;


class MainController extends BaseController {

    public function start(  ){

        //
        $controller = $this->request->getGetValue('ctrl');

        $action = $this->request->getGetValue('act');

        try{

            MySQL::$db = new \PDO(
                "mysql:host=localhost;dbname=vtaminka;charset=utf8",
                'vtamin',
                '123456'
            );

        }//try
        catch( \PDOException $ex ){
            die( "DATABASE CONNECTION ERROR! {$ex->getMessage()}" );
        }//catch

        $controllerClass = "controllers\\panel\\{$controller}Controller";

        if(class_exists($controllerClass)){
            $controllerInstance = new $controllerClass();
        }//if
        else if (class_exists( "controllers\\api\\{$controller}Controller")){
            $apiController = "controllers\\api\\{$controller}Controller";
            $controllerInstance = new $apiController();
            $controllerClass = "controllers\\api\\{$controller}Controller";
        }//else if
        else{
            $controller = "Home";
            $action = "index";
            $controllerClass = "controllers\\panel\\{$controller}Controller";
            $controllerInstance = new $controllerClass();
        }//else

        if(method_exists($controllerClass, "{$action}Action")){
            $viewToInclude = $controllerInstance->{"{$action}Action"}();
        }
        else{
            $controller = "Home";
            $action = "index";
            $controllerClass = "controllers\\panel\\{$controller}Controller";
            $controllerInstance = new $controllerClass();
            $viewToInclude = $controllerInstance->{"{$action}Action"}();
        }

        $this->view = $controllerInstance->view;


        include_once "views/Default/header.php";

        include_once "views/$controller/$viewToInclude.php";

        //include_once "views/Default/footer.php";

    }//start


}

