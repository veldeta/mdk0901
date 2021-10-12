<?php
session_start();

if(!$_SESSION['bool']){
    $_SESSION['bool'] = ['form' => true, 'answer' => false];
}

if($_GET){
    header("location: {$_SERVER['PHP_SELF']}");
    exit;
}

if($_POST['num']){
    $_SESSION['bool'] = ['form' => false, 'answer' => true];

    $sum = $_POST['num'];
    $ot = 'Неправильный';
    if($sum == $_SESSION['sum']){
        $ot = 'Правильный';
    }
    $_SESSION['text'] = <<<END
    Ответ $ot<br>
    Ваш ответ: {$sum}<br>
    Правильный ответ: {$_SESSION['sum']}
    END;
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

$n = rand(1,10);
$_SESSION['sum'] = 10 * $n;

if($_SESSION['bool']['form']){
echo <<<END
<form action="{$_SERVER['PHP_SELF']}" method="post">
    <div>
        <label>
            10 * n =
            <input type="number" name="num" required>
        </label>
        <label>
            <input type="submit" name="send" value="Ответить">
        </label>
    </div>
</form>
END;
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['bool']['answer']){
    echo $_SESSION['text'];
    echo "<br><a href='{$_SERVER['PHP_SELF']}' style='text-decoration: none'><button>Повторить</button></a>";
    unset($_SESSION['bool']);
}
