<?php
$login = 'gg';
$mass = [
    'date_stmt' => $login,
    'type' => 's',
    'date_answer' => ['login' => 'login','pass'=> 'pass','name_user'=> 'name_user','date'=> 'date','email'=> 'email'],
];

$query = "SELECT login, password, name_user, _date, email FROM users WHERE login=?";

$cook = mysql_stmt($query, $mass, true);
var_dump($cook);

function fpp($a,$b){
    echo $a + $b; 
}

function mysql_stmt($query, $mass = null, $answer = false){

    $type = $mass['type'];
    $pos = $mass['date_answer'];

    $link =  mysqli_connect('localhost','root', '','users_laba2');

    if(!mysqli_connect_errno()){

        $stmts = mysqli_prepare($link, $query);

        if(is_array($mass['date_stmt'])){
            if(count($mass['date_stmt']) > 1){
                mysqli_stmt_bind_param($stmts, $type, ...$mass['date_stmt']);
            }
        } else {
            mysqli_stmt_bind_param($stmts, $type, $mass['date_stmt']);
        
        }

        mysqli_stmt_execute($stmts);
        
        foreach($pos as $key => $value){
            $param[] = &$row[$key];
        }

        call_user_func_array(array($stmts, 'bind_result'), $param);

        mysqli_stmt_fetch($stmts);

        if($answer){
            $res = $param;
        }
    } else {
        $error = ("Не удалось подключиться: %s\n" . mysqli_connect_error());
    }
    mysqli_stmt_close($stmts);
    mysqli_close($link);

    $ret = $error ?? $res;
    return $ret; 
}