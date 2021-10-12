<?php
session_start();

$n = rand(1, 10);
$check = 5 * $n;
$_SESSION['check'] = $check;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answer = $_POST['answer'];
    $_SESSION['answer'] = $answer;

    if ($answer == $check) {
        $_SESSION['res'] = true; 
    } else {
        $_SESSION['res'] = false;
    }
}
if (!$_POST) {
?>

<form action="<? $_SERVER['PHP_SELF'] ?>" method="POST">
    <label>5 * n = ?
        <input name="answer" placeholder="n - число от 1 до 10" type="number">
        <input name="submit" type="submit" value="Отправить">
</label>

<?
} else {
    if (isset($_SESSION['res'])) {        
            echo ($_SESSION['res'] == true) ? "Вы угадали результат! =)" . "<br>" : "Вы неверно ответили =( Правильный ответ:" . $_SESSION['check'] . "<br>";
            echo "<a href=" . $_SERVER['PHP_SELF'] . "><button>Повторить</button></a>";
            unset($_SESSION['answer']);
            unset($_SESSION['res']);
            unset($_SESSION['check']);
    } 
}

?>