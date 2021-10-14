<?php
/**
 * Подключение к базе данныех
 * Обработка данных
 * Получение массива данных если не было ошибок перед этим
 * если ошибка возращает значение false
 */
function my_sql($value, $login, $query = null){
    
    $mysqli = mysqli_connect('localhost', 'root','','users_laba2');

    if(!mysqli_connect_error()){
        $select = "SELECT `login`, `password`, `name_user`, `_date`, `email` FROM `users` WHERE `login`='" . $login . "'";
        $result = mysqli_query($mysqli,$select);

        if($value == 'registration' && $result->num_rows == 0){
            if(mysqli_query($mysqli, "INSERT INTO `users` (`login`, `password`, `name_user`, `_date`, `email`) VALUES ('" . $query)){
                $ma = mysqli_query($mysqli, $select);
                $info = mysqli_fetch_assoc($ma);
            }
        } elseif($value == 'authorization' && $result->num_rows != 0){
            $info = mysqli_fetch_assoc($result);
        } else {
            $info = false;
        }
    } else {
        $info = false;
    }
    mysqli_close($mysqli);
    return $info;
}


// Вывод горизонтального и вертекального меню
function sr_main($arr_in, $g = false, $paramets = null, $type = false){
    $g = ($g) ? 'display: inline-block;' : ''; 
    $paramets = ($paramets) ? '&paramets=' . $paramets : '';
    $s = [];
    if($type == 'css'){
        $start = "<link rel='stylesheet' href='";
        $end = "'>";   
    } elseif ($type == 'js'){
        $start = "<script src='";
        $end = "'></script>";
    }

    if($type && $arr_in){
        foreach($arr_in as $key => $value){
            $href = "acce/" . $value;
            if($key == $_GET['page'] || ($_GET['paramets']) ? $key == $_GET['paramets'] : ''){
                if(is_file($href)){
                    $s[$type] .= $start . $href . $end;
                }
            }

        }
    }
    if($_GET['page']) $_SESSION['id'] = $_GET['page'] ?? $_GET['paramets'];
    if(!$type){
        $s['ul'] = "<ul class='stroka'>";
        foreach($arr_in as $key => $val){
            if($key == 'acce' || $key == $_SESSION['cook']){
                continue;    
            }
            if($key == $_SESSION['id'] && $key != 'registration' && $key != 'main'){
                $id = "id='{$_SESSION['id']}'";
            }

            $s['ul'] .= "<li {$id} style='{$g} margin: 0 10px'><a href='{$_SERVER['PHP_SELF']}?page={$val['page']}{$paramets}'>{$val['ru']}</a></li>";
            unset($id);
        }
        $s['ul'] .= "</ul>";
    }
    return $s;
}


//Разлогирования
function logout(){
    setcookie('user', '', time()-3);
    unset($_SESSION['cook']);
}

/**
 * Обработка данных 
 */
function handler($post){
    $login = trim(strip_tags($post['login']));
    $pass = trim(strip_tags($post['pass']));
    $pass2 = trim(strip_tags($post['pass2']));
    $fio = trim(strip_tags($post['fio']));
    $date = trim(strip_tags($post['date']));
    $email = trim(strip_tags($post['email']));

    $_SESSION['data'] = ['login' => $login, 'fio' => $fio, 'date' => $date, 'email' => $email];

    if(strlen($pass) < 8){
        $_SESSION['error'] = ['pass' => 'Пароль должен быть не менее 8 символов'];
        header("location: {$_SERVER['PHP_SELF']}" . REGISTRATION);
        exit;
    }

    if($pass != $pass2){
        $_SESSION['error'] = ['pass' => 'Пароли не совпадают, введите коректный пароль.'];
        header("location: {$_SERVER['PHP_SELF']}" . REGISTRATION);
        exit;
    }

    if($date){
        $do = time();
        $date_if = date_create($date);
        date_add($date_if, date_interval_create_from_date_string('18 years'));
        $d = date_format($date_if, 'U');
        if($d >= $do){
            unset($_SESSION['data']['date']);
            $_SESSION['error'] =['age' => 'Минимальный возраст для регистрации 18 лет.'];
            header("location: {$_SERVER['PHP_SELF']}" . REGISTRATION);
            exit;
        }
    }
    $query =  $login ."','". password_hash($pass, PASSWORD_DEFAULT) ."','". $fio ."','". $date ."','". $email ."')";
    if(!$cook = my_sql('registration', $login, $query)){
        unset($_SESSION['data']['login']);
        $_SESSION['error'] = ['login' => "Пользователь с таким ников уже существует, выберейти другой."];;
        header('Location: '. $_SERVER['PHP_SELF'] . REGISTRATION);
        exit;
    }
    $_SESSION['cook'] = 'registration';
    setcookie('user', base64_encode(serialize($cook)), time()+3600*24*30);
    unset($_SESSION['data']);
}
//Аутентификация
function log_user($post) {
    $login = trim(strip_tags($post['login']));
    $pass = trim(strip_tags($post['pass']));

    if($arr_data = my_sql('authorization', $login)){
        if(!(password_verify($pass, $arr_data['password']))){
            header("location: {$_SERVER['PHP_SELF']}" . MAIN);
            $_SESSION['error'] = ["auth" => "Не верный логин или пароль."];
            exit;
        }
        $_SESSION['cook'] = 'registration';
        setcookie('user', base64_encode(serialize($arr_data)), time()+3600*24*30);
    } else {
        $_SESSION['error'] = ["auth" => "Не верный логин или пароль."];
    }   
}