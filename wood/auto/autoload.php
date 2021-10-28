<?php
function autoload($class){
    $dir =  scandir(DIR);
    array_shift($dir);
    array_shift($dir);
    foreach($dir as $val){
        if(is_dir($val) && $val != 'auto'){
            dirr($val, $class);
        }

        if(is_file($val)){
            if($class . '.php' == $val){
                include  $val;
            }
        }   
    }
}

function dirr($dir, $class)
{
    $arr = scandir($dir);

    array_shift($arr);
    array_shift($arr);
    foreach($arr as $val){       
        if(is_dir($dir . '/' . $val) && $val != 'auto'){
            dirr($dir . '/' . $val, $class);
        }

        if(is_file($dir . '/' . $val)){
            if($class . '.php' == $val){
                include $dir . '/' . $val;
            }
        }
    }
}

spl_autoload_register('autoload');