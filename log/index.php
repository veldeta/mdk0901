<?php 

if($_POST){
    $name = trim(strip_tags($_POST['name']));
    $age = trim(strip_tags($_POST['age']));
    $login = trim(strip_tags($_POST['login']));
    $pass =  password_hash(trim(strip_tags($_POST['password'])), PASSWORD_DEFAULT);

    if($_POST['send']){
        setcookie("user_info", base64_encode(serialize(['name' => $name, 'age' => $age, 'login' => $login, 'pass' => $pass])), time()+3600*24*30);
    }

    if($_POST['logout']){
        setcookie('user_info', '', time() - 3600);
    }
    header("location: {$_SERVER['PHP_SELF']}");
    exit;
}

if(empty($_COOKIE['user_info'])){
    ?>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
    <div>
        <label>
            ФИО:
            <input type="text" name="name" required>
        </label>
    </div>
    <div>
        <label>
            Возраст:
            <input type="number" name="age" required>
        </label>
    </div>
    <div>
        <label>
            Логин:
            <input type="text" name="login" required>
        </label>
    </div>
    <div>
        <label>
            Пароль:
            <input type="password" name="password" required>
        </label>
    </div>
    <div>
        <input type="submit" value="Войти" name="send">
    </div>
</form>
<? 
} else {     
    if($user_info = unserialize(base64_decode($_COOKIE['user_info'])))
    
        if($user_info['login']){
            
            if(isset($user_info['count'])){
                $user_info['count'] += 1;
            } else {
                $user_info['count'] = 1;
            }
            
            setcookie("user_info", base64_encode(serialize($user_info)), time()+3600*24*30);

            echo <<<END
            Имя: {$user_info['name']}<br>
            Возраст: {$user_info['age']}<br>
            Логин: {$user_info['login']}<br>
            Количество заходов: {$user_info['count']}<br>
            END;
?>

<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
    <div>
        <input type="submit" value="Выход" name="logout">
    </div>
</form>
<? 
        }
} 
?>