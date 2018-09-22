<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 10:58
 */

namespace controllers\panel;


class HomeController extends BaseController{

    public function indexAction(  ){

        $this->view->title = "Hello, i'am index action";

        return 'index';

    }//index

}