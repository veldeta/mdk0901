<?
session_start();

require_once 'php/array.php';
require_once 'php/function.php';
require_once 'php/security.php';

if (!empty($_POST)) {
    if (password_verify($ha, $_POST['hash']) && $_POST['sendreg']) {
        handler($_POST);
    } elseif (password_verify($ha, $_POST['hash']) && $_POST['logout']) {
        logout();
    } elseif (password_verify($ha, $_POST['hash']) && $_POST['sendlogin']) {
        log_user($_POST);
    }
    header('location: ' . $_SERVER['PHP_SELF'] . MAIN);
    exit;
}
if ($_SERVER['PATH_INFO']) {
    header("location: {$_SERVER['SCRIPT_NAME']}");
    exit;
}

$page = $_GET['paramets'] ?? $_GET['page'];

if (!$page && $_GET) {
    header("Location:{$_SERVER['PHP_SELF']}" . MAIN);
    exit;
}

if ($_COOKIE['user']) {
    $user = unserialize(base64_decode($_COOKIE['user']));
    $ex = 'registration';
}
if ($page) {
    if (!array_key_exists($_GET['page'], $arr) || ($_GET['paramets'])
        ? (array_key_exists($page, $arr))
        ? !array_key_exists($_GET['page'], $arr[$page]['sub']) : true : '' || $_GET['page'] == $ex
    ) {
        header("Location:{$_SERVER['PHP_SELF']}" . MAIN);
        exit;
    }
}

$hash = password_hash($ha, PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Лаба 1</title>
    <link rel='stylesheet' href="acce/<?= $arr['acce']['css']['name'] ?>">
    <?
    $mass =  sr_main($arr['acce']['css'][$page], false, null, 'css');
    echo $mass['css'];
    ?>
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
            <?
            $main = sr_main($arr, true);
            echo $main['ul'];
            ?>


            <div id="st" style="display: flex;" class="v">
                <?
                if ($page && !$arr[$page]['sub'] && $page != 'registration') {
                    include_once 'html/auto.html';
                }
                // if ($page && $arr[$page]['sub']) {
                //     $mass = sr_main($arr[$page]['sub'], false, $page);
                //     echo $mass['ul'];
                // } else {
                //     if ($page != 'registration')
                //         include_once 'html/auto.html';
                // }
                ?>
            </div>
            <?
            if ($_GET['paramets']) {
                $html = "html/{$arr[$page]['sub'][$_GET['page']]['html']}";
                if (is_file($html)) {
                    include_once $html;
                }
            } elseif ($_GET['page']) {
                $html = "html/{$arr[$page]['html']}";
                if (is_file($html)) {
                    include_once $html;
                }
            }
            ?>
        </main>
        <footer></footer>

    </div>

    <?
    // echo "<script>let id_page = '{$_SESSION['id']}'</script>";
    echo "<script src='acce/{$arr['acce']['js']['name']}'></script>";
    $mass = sr_main($arr['acce']['js'][$page], false, null, 'js');
    echo $mass['js'];
    ?>

</body>

</html>