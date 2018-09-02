<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 19.08.2018
 * Time: 10:32
 */

namespace utils;


class View{

    private $storage = [];

    public function __get($name){
        //$v = new View();
        //$v->product = new Product();

        //<h1> <?= $v->product->title </h1>

        if(isset($this->storage[$name])){
            return $this->storage[$name];
        }//if

        return null;

    }//__get

    public function __set($name, $value){

        $this->storage[$name] = $value;

    }//__set

}