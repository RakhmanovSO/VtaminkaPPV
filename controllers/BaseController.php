<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 10:18
 */

namespace controllers;


use utils\Request;
use utils\View;

class BaseController{

    public $view;
    protected $request;


    public function __construct(){

        $this->view = new View();
        $this->request = new Request();

    }//__construct

    public function redirect(  ){



    }

    public function json( $value ){

        header('Content-type: application/json');

        echo json_encode( $value );
        exit();

    }//json

}