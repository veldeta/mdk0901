<?php
session_start();
if(is_file('bank.php')){
    include 'bank.php';
}
if(!empty($_POST)){
    $file =  fopen('bank.php', 'x');
        if($file){
        fwrite($file, 
        <<<'PHP'
        <?php
        echo 'Привет, как твои дела?';
        if(5 > 4){
            $s = 10;
        } else {
            $s = 20;
        }
        PHP
        
        );
        $_SESSION['create'] = true;
        fclose($file);
    }
    
    header('location:'. $_SERVER['PHP_SELF']);
    exit;
}

if($_SESSION['create']){
    echo "<script>alert('Файл был успешно создан!')</script>";
    unset($_SESSION['create']);
}


echo <<<FORM
<form action='{$_SERVER['PHP_SELF']}' method='post'>
    <input type="submit" name="send" value="Создать">
</form>
FORM;