<?php
// function my_sql($value, $login, $query = null){

//     $mysqli = mysqli_connect('localhost', 'root','','users_laba2');

//     if(!mysqli_connect_error()){
//         $select = "SELECT `login`, `password`, `name_user`, `_date`, `email` FROM `users` WHERE `login`='" . $login . "'";
//         $result = mysqli_query($mysqli,$select);

//         if($value == 'registration' && $result->num_rows == 0){
//             if(mysqli_query($mysqli, "INSERT INTO `users` (`login`, `password`, `name_user`, `_date`, `email`) VALUES ('" . $query)){
//                 $ma = mysqli_query($mysqli, $select);
//                 $info = mysqli_fetch_assoc($ma);
//             }
//         } elseif($value == 'authorization' && $result->num_rows != 0){
//             $info = mysqli_fetch_assoc($result);
//         } else {
//             $info = false;
//         }
//     } else {
//         $info = false;
//     }
//     mysqli_close($mysqli);
//     return $info;
// }

/**
 * $query = "SELECT login FROM users WHERE login=?" 
 * 
 */
function mysql_stmt($query, $mass = null, $answer = false)
{

    $params = $mass['date_stmt'];
    $type = $mass['type'];
    $pos = $mass['date_answer'];
    $row = [];
    $link =  mysqli_connect('localhost', 'root', '', 'users_laba2');

    if (!mysqli_connect_errno()) {

        $stmts = mysqli_prepare($link, $query);

        if (is_array($params)) {
            mysqli_stmt_bind_param($stmts, $type, ...$mass['date_stmt']);
        } else {
            mysqli_stmt_bind_param($stmts, $type, $mass['date_stmt']);
        }

        if (!empty($pos)) {

            foreach ($pos as $key => $value) {
                $param[] = &$row[$key];
            }
            call_user_func_array(array($stmts, 'bind_result'), $param);
        }

        $res = mysqli_stmt_execute($stmts);

        if (!empty($pos)) {
            mysqli_stmt_fetch($stmts);
        }

        if ($answer) {
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


// Вывод горизонтального и вертикального меню
function sr_main($arr_in, $g = false, $paramets = null, $type = false)
{

    function sr_main_little($val, $paramets = null, $con = null, $class = 'oops', $leri = null){
        $sub = $val['sub'];
        $s = "<ul  class='{$class} {$leri}'>";
        foreach ($val['sub'] as $keys => $value) {
            $s .= "<li style='margin: 0 10px'><a href='{$_SERVER['PHP_SELF']}?page={$value['page']}{$paramets}'>{$value['ru']}</a></li>";
            if($keys == $_GET['page'] && $sub[$keys]['sub']){
                array_shift($con);
                array_pop($con);
                $leri = (array_search($_GET['paramets'],$con) > round((count($con) - 1) / 2, 0, PHP_ROUND_HALF_UP))? 'left' : 'ritgh';
                $s .= sr_main_little($sub[$keys], null, null, 'oopss', $leri);
            }
        }
        $s .= "</ul>";
        
        return $s;
    }



    $g = ($g) ? 'display: inline-block;' : '';
    // $paramets = ($paramets) ? '&paramets=' . $paramets : '';
    $s = [];
    if ($type == 'css') {
        $start = "<link rel='stylesheet' href='";
        $end = "'>";
    } elseif ($type == 'js') {
        $start = "<script src='";
        $end = "'></script>";
    }

    if ($type && $arr_in) {
        foreach ($arr_in as $key => $value) {
            $href = "acce/" . $value;
            if ($key == $_GET['page'] || ($_GET['paramets']) ? $key == $_GET['paramets'] : '') {
                if (is_file($href)) {
                    $s[$type] .= $start . $href . $end;
                }
            }
        }
    }

    if (!$type) {
        $con = array_keys($arr_in);
        $s['ul'] = "<ul class='stroka'>";
        foreach ($arr_in as $key => $val) {
            if ($key == 'acce' || $key == $_SESSION['cook']) {
                continue;
            }
            $argument = $_GET['paramets'] ?? $_GET['page'];
            if ($argument == $key && $val['sub']) {
                $paramets = "&paramets=" . $argument;
                $s['ul'] .= "<li style='margin: 0 10px'><a href='{$_SERVER['PHP_SELF']}?page={$val['page']}'>{$val['ru']}</a>";
                $s['ul'] .= sr_main_little($val, $paramets, $con);
                $s['ul'] .= "</li>";
            } else {
                $s['ul'] .=  "<li style='{$g} margin: 0 10px'><a href='{$_SERVER['PHP_SELF']}?page={$val['page']}'>{$val['ru']}</a></li>";
            }
        }
        $s['ul'] .= "</ul>";
    }
    return $s;
}


//Разлогирования
function logout()
{
    setcookie('user', '', 1);
    unset($_SESSION['cook']);
}

/**
 * Обработка данных 
 */
function handler($post)
{
    $login = trim(strip_tags($post['login']));
    $pass = trim(strip_tags($post['pass']));
    $pass2 = trim(strip_tags($post['pass2']));
    $fio = trim(strip_tags($post['fio']));
    $date = trim(strip_tags($post['date']));
    $email = trim(strip_tags($post['email']));

    $_SESSION['data'] = ['login' => $login, 'fio' => $fio, 'date' => $date, 'email' => $email];

    if (strlen($pass) < 8) {
        $_SESSION['error'] = ['pass' => 'Пароль должен быть не менее 8 символов'];
        header("location: {$_SERVER['PHP_SELF']}" . REGISTRATION);
        exit;
    }

    if ($pass != $pass2) {
        $_SESSION['error'] = ['pass' => 'Пароли не совпадают, введите коректный пароль.'];
        header("location: {$_SERVER['PHP_SELF']}" . REGISTRATION);
        exit;
    }

    if ($date) {
        $do = time();
        $date_if = date_create($date);
        date_add($date_if, date_interval_create_from_date_string('18 years'));
        $d = date_format($date_if, 'U');
        if ($d >= $do) {
            unset($_SESSION['data']['date']);
            $_SESSION['error'] = ['age' => 'Минимальный возраст для регистрации 18 лет.'];
            header("location: {$_SERVER['PHP_SELF']}" . REGISTRATION);
            exit;
        }
    }

    $query = "INSERT INTO users (login, password, name_user, _date, email) VALUES (?,?,?,?,?)";

    $mass = [
        'date_stmt' => [$login, password_hash($pass, PASSWORD_DEFAULT), $fio, $date, $email],
        'type' => 'sssss'
    ];

    if (!mysql_stmt($query, $mass)) {
        unset($_SESSION['data']['login']);
        $_SESSION['error'] = ['login' => "Пользователь с таким ников уже существует, выберейти другой."];;
        header('Location: ' . $_SERVER['PHP_SELF'] . REGISTRATION);
        exit;
    }
    $_SESSION['cook'] = 'registration';
    $cookei = $mass['date_stmt'];
    setcookie('user', base64_encode(serialize($cookei)), time() + 3600 * 24 * 30);
    unset($_SESSION['data']);
}

//Аутентификация
function log_user($post)
{
    $login = trim(strip_tags($post['login']));
    $pass = trim(strip_tags($post['pass']));

    $query = "SELECT login, password, name_user, _date, email FROM users WHERE login=?";

    $mass = [
        'date_stmt' => $login,
        'type' => 's',
        'date_answer' => ['login' => 'login', 'pass' => 'pass', 'name_user' => 'name_user', 'date' => 'date', 'email' => 'email'],
    ];

    if ($cook = mysql_stmt($query, $mass, true)) {
        if (!(password_verify($pass, $cook[1]))) {
            header("location: {$_SERVER['PHP_SELF']}" . MAIN);
            $_SESSION['error'] = ["auth" => "Не верный логин или пароль."];
            exit;
        }
        $_SESSION['cook'] = 'registration';
        setcookie('user', base64_encode(serialize($cook)), time() + 3600 * 24 * 30);
    } else {
        $_SESSION['error'] = ["auth" => "Не верный логин или пароль."];
    }
}
