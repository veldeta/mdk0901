<?php

spl_autoload_register(function ($class){
    var_dump($class);
    include $class . '.class.php';
});
