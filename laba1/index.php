<? 
session_start();

require_once 'php/array.php';
require_once 'php/function.php';
require_once 'php/security.php';

if(!empty($_POST)){
    if(password_verify($ha, $_POST['hash']) && $_POST['sendreg']){
        sql($_POST);
    } elseif(password_verify($ha, $_POST['hash']) && $_POST['logout']){
        exi();    
    } elseif(password_verify($ha, $_POST['hash']) && $_POST['sendlogin']){
        log_user($_POST);
    }
    header('location: '. $_SERVER['PHP_SELF'] . '?page=main');
    exit;
}

if($_SERVER['PATH_TRANSLATED']){
    header("location: {$_SERVER['SCRIPT_NAME']}");
    exit;
}

$page = $_GET['paramets'] ?? $_GET['page'];

if(!$page && $_GET){
    header("Location:{$_SERVER['PHP_SELF']}?page=main");
    exit;
}
$ex = ($_COOKIE['user'])? 'registration' : '';
if($page){
    if(!array_key_exists($_GET['page'], $arr) || ($_GET['paramets']) 
    ? (array_key_exists($page, $arr)) 
    ? !array_key_exists($_GET['page'], $arr[$page]['sub']) : true : '' || $_GET['page'] == $ex)
    {    
        header("Location:{$_SERVER['PHP_SELF']}?page=main");
        exit;
    
    }
}

if($_COOKIE['user']){
    $user = unserialize(base64_decode($_COOKIE['user']));
}
$hash = password_hash($ha, PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Лаба 1</title>
    <link rel='stylesheet' href="acce/<?= $arr['acce']['css']['name']?>">
    <?= href($arr['acce']['css'][$page]) ?>
</head>

<body>
    <div class="main">
        <header>
            <img src="logo.png" class="image" alt="логотип">
            <h3>
                Электронный журнал <a style="text-decoration: none; color: black;" href="../index.html">РТК</a>
            </h3>
        </header>
        <main>
            <?= sr_main($arr, true);?>
            
            <div style="display: flex;">
                <? 
                    if($page && $arr[$page]['sub']){
                        echo sr_main($arr[$page]['sub'], false, $page);
                    } else {
                        if($page != 'registration')
                            include_once 'html/auto.html';
                    }
                ?>
            
                <?
                    if($_GET['paramets']) {
                        $html = "html/{$arr[$page]['sub'][$_GET['page']]['html']}";
                        if(is_file($html)){
                            include_once $html;
                        }
                    } elseif($_GET['page']){
                        $html = "html/{$arr[$page]['html']}";
                        if(is_file($html)){
                            include_once $html;
                        }
                    }
                ?>
            </div>
        </main>
        <footer></footer>

    </div>

    <?= href($arr['acce']['js'][$page], true)?>

</body>
</html>
