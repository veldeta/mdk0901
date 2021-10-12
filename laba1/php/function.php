<?php
function my_sql(){
    // $mysql = mysqli_connect('localhost', 'root','','user');
    $mysql = mysqli_connect('localhost', 'root','','users_laba2');

    if(mysqli_connect_error()){
        echo 'Не удалось подключиться к базе данных' . mysqli_connect_errno() . ' -> ' . mysqli_connect_error();
        exit;
    }
    return $mysql;
}

function sr_main($arr_in, $g = false, $paramets = null){
    $g = ($g) ? 'display: inline-block;' : ''; 
    $paramets = ($paramets) ? '&paramets=' . $paramets : '';
    $b = ($_COOKIE['user']) ? 'registration' : '';
    $s = "<ul class='stroka'>";
    foreach($arr_in as $key => $val){
        if($key != 'acce' && $key != $b){
            $s .= "<li style='{$g} margin: 0 10px'><a href='{$_SERVER['PHP_SELF']}?page={$val['page']}{$paramets}'>{$val['ru']}</a></li>";
        }
    }
    $s .= "</ul>";
    return $s;
}

function href($arr, $js = false){

    $start = ($js) ? "<script src='"  : "<link rel='stylesheet' href='";
    $end = ($js) ? "'></script>" : "'>";
    if($arr){
        foreach($arr as $key => $value) {
            $href = "acce/" . $value;
            if($key == $_GET['page'] || ($_GET['paramets']) ? $key == $_GET['paramets'] : ''){
                if(is_file($href)){
                    $s .= $start . $href . $end;
                }
            }
        }
    }
    return $s;
}

function exi(){
    setcookie('user', '', time()-3600);
}

function res($login, $mysqli){
    return mysqli_query($mysqli,"SELECT `login`, `password`, `name_user`, `_date`, `email` FROM `users` WHERE `login`='" . $login . "'");
}

function sql($post){
    $login = trim(strip_tags($post['login']));
    $pass = trim(strip_tags($post['pass']));
    $pass2 = trim(strip_tags($post['pass2']));
    $fio = trim(strip_tags($post['fio']));
    $date = trim(strip_tags($post['date']));
    $email = trim(strip_tags($post['email']));

    if(!strlen($pass) >= 8){
        $_SESSION['error'] = ['pass' => 'Пароль должен быть не менее 8 символов'];
        header("location: {$_SERVER['PHP_SELF']}?page=registration");
        exit;
    }

    if($pass != $pass2){
        $_SESSION['error'] = ['pass' => 'Пароли не совпадают, введите коректный пароль.'];
        header("location: {$_SERVER['PHP_SELF']}?page=registration");
        exit;
    }

    if($date){
        $do = date('U') - 3600*24*30*12*18;
        if(!($do >= strtotime($date))){
            $_SESSION['error'] =['age' => 'Минимальный возраст для регистрации 18 лет.'];
            header("location: {$_SERVER['PHP_SELF']}?page=registration");
            exit;
        }
    }
    $mysqli = my_sql();
   
   
    
    $result = res($login,$mysqli);
    if($result->num_rows == 0){
        // mysqli_query($mysqli, "INSERT INTO `users` (`login`, `password`, `fio`, `_date`, `email`) VALUES ('". $login ."','". $pass ."','". $fio ."','". $date ."','". $email ."')");
        mysqli_query($mysqli, "INSERT INTO `users` (`login`, `password`, `name_user`, `_date`, `email`) VALUES ('". $login ."','". password_hash($pass, PASSWORD_DEFAULT) ."','". $fio ."','". $date ."','". $email ."')");
    } else {
        $_SESSION['error'] = ['login' => "Пользователь с таким ников уже существует, выберейти другой."];
        header('Location: '. $_SERVER['PHP_SELF'] . '?page=registration');
        exit;
    }

    $result = res($login,$mysqli);
    $cook = mysqli_fetch_assoc($result);
    mysqli_close($mysqli);
    
    setcookie('user', base64_encode(serialize($cook)), time()+3600*24*30);
}

function log_user($post) {
    $login = trim(strip_tags($post['login']));
    $pass = trim(strip_tags($post['pass']));

    $mysqli = my_sql();
    $result = res($login, $mysqli);

    if($result->num_rows != 0){
        $cook = mysqli_fetch_assoc($result);
        mysqli_close($mysqli);
        if(!(password_verify($pass, $cook['password']))){
            header("location: {$_SERVER['PHP_SELF']}?page=main");
            $_SESSION['error'] = ["auth" => "Не верный логин или пароль."];
            exit;
        }
        setcookie('user', base64_encode(serialize($cook)), time()+3600*24*30);
    } else {
        $_SESSION['error'] = ["auth" => "Не верный логин или пароль."];
    }
}