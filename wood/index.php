<?php

const DIR = __DIR__;
$db = require_once "lib/config/db.php";
$tree = require_once "lib/tree/tree.php";
require_once 'auto/autoload.php';

try{
    $mysqli = new Sqli($db);
    if($mysqli->connected()){
        $obj = new createTree();
        $obj->create($tree);
        echo $obj->getcount() - 1;
        $mysqli->myClose();
    }
} catch (Exception $e){
    echo $e->getMessage();
}