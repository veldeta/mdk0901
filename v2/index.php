<?php
session_start();

$ban = file('ban.txt');

if($_SERVER['PATH_TRANSLATED']){
    header('location: '. $_SERVER['SCRIPT_NAME']);
}

if(array_search($_SERVER['REMOTE_ADDR'], $ban)) {
    echo "Вы были заблокированы, ждите разбана!";
    die;
}  

if( $_GET ){
    header("location: {$_SERVER['PHP_SELF']}");
    exit;
}
 
if(!$_SESSION['bool']){
    $_SESSION['bool'] = false;
}

$_SESSION['hash'] = password_hash('1234567890ZYXWVUTSRQPONMLKJIHGFEDCBAzyxwvutsrqponmlkjihgfedcba', PASSWORD_DEFAULT );
$n = rand(1,10);
$_SESSION['sum'] = 10 * $n;
$_SESSION['index'] = $_SERVER['PHP_SELF'];
var_dump($_SESSION);

if(!$_SESSION['bool']){   
    echo <<<END
    <form action="obr.php" method="post">
        <div>
            <label>
                10 * n =
                <input type="number" name="num" required>
            </label>
            <label>
                <input type="hidden" name="index" value="{$_SESSION['hash']}">
            </label>
            <label>
                <input type="submit" name="send" value="Ответить">
            </label>
        </div>
    </form>
    END;
}
if($_SESSION['bool'] == 'answer'){
    $_SESSION['bool'] = false;
    echo $_SESSION['text'];
    echo "<br><a href='{$_SERVER['PHP_SELF']}' style='text-decoration: none'><button>Повторить</button></a>";
}