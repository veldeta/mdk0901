<?php
const DIR = __DIR__;
$db = require_once 'lib/config/db.php';
require_once 'data/auto.php';
try{
    $session = new Session();
    $session->setSession('user', 'Иван');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая работа №4</title>
</head>
<body>
    
<?php

    echo $session->getSession('user'). ' <br>';
    
    if($session->notNullSession('user')){
        echo "Ok <br>\n";
    } else {
        echo "notOk <br>\n";
    }

    $form = Form::Begin([
        'action' => $_SERVER['SCRIPT_NAME'],
        'method' => 'post'
    ]); 

    echo $form->input(["type" => "text", "value" => "aaa"])->print('input');
    echo $form->password(["value" => "aaa"]);
    echo $form->textarea(["value" => "aaa", "placeholder" => "123"]);
    echo $form->submit(["value" => "Отправить форму"]);

    Form::end();

    $mysqli = new Mysql($db);
    if($mysqli->connected()){
       
        $p = $mysqli->stmt([
            'query' => 'SELECT * FROM users',
            'data_answer' => ['id', 'login', 'password', 'name_user', 'date', 'email', 'admin'],
            'all' => true
        ]);
        
        if(is_array($p)){
            foreach($p as $v){
                echo "<ul>\n";
                if(is_array($v)){
                    foreach($v as $vv){
                        echo "  <li> {$vv} </li>\n";
                    }
                } else {
                    echo "  <li> {$v} </li>\n";
                }
                echo "</ul>\n";
            }  
        }      
    }
} catch(Exception $e){
    echo $e->getMessage();
}
?>
</body>
</html>