<?php 
session_start();

function b (){
    if($_POST['index'] != $_SESSION['hash'] || $_SERVER['REQUEST_METHOD'] === "GET"){
    
        $file = file('ban.txt');
        if(array_search($_SERVER['REMOTE_ADDR'], $file)) {
            header("location: {$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");
            die;
        } 

        $ban = fopen('ban.txt', 'a');
        fwrite($ban, "\n".$_SERVER['REMOTE_ADDR']);
        fclose($ban);
        
        header("location: {$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");
        die;
    }
}

if(!empty($_POST)) {
    b();

    if($_POST['index'] == $_SESSION['hash']){
        $num = $_POST['num'];
        $answer = "Неправильный";
        if($num == $_SESSION['sum']){
            $answer = 'Правильный';
        }
        $_SESSION['text'] = <<<END
        Ответ $answer <br>
        Ваш ответ: {$num}<br>
        Правильный ответ: {$_SESSION['sum']}
        END;
        
        $_SESSION['bool'] = 'answer';

        header("location: {$_SESSION['index']}");
        exit();
    }
} else {
    b();
}
