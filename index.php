<?php

use controllers\MainController;

function LoadClass( $class ){

    if( file_exists("$class.php") ){
        require_once "$class.php";
    }//if

}//LoadClass


spl_autoload_register('LoadClass');

$app = new MainController();
$app->start();
