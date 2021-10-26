<?php

spl_autoload_register(function ($name){
    include $name . '.php';
});

$us = new main();
