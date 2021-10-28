<?php

// use error\MysqliError;
// use MysqliSlava;

spl_autoload_register(function($class){
    var_dump($class);
    include 'lib/config/' . $class . '.php';
    // include 'lib/' . $class . '.php';
});


$v = new MysqliSlava;
$v->myOpen();
var_dump($v->myClose()); 