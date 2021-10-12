<?php
$arr = range(2,9);
if($_SERVER['PATH_TRANSLATED']){
    header('location: '. $_SERVER['SCRIPT_NAME']);   
}

if(isset($_GET['page'])){
    if(!in_array($_GET['page'], $arr) || strlen($_GET['page']) > 1){
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

function tableM($i,$arr){
    for($j=1; $j<=10; $j++){
        $x = (in_array($i, $arr)) ? "<a href='{$_SERVER['PHP_SELF']}?page=".$i."'>{$i}</a>" : $i;
        $y = (in_array($j, $arr)) ? "<a href='{$_SERVER['PHP_SELF']}?page=".$j."'>{$j}</a>" : $j;
        echo $x . ' * ' . $y . ' = ' . $i*$j;
        echo '<br>';
    }
}

$page = $_GET['page'];

echo '<br>';

if($page){
    echo tableM($page, $arr);
    echo "<a href='{$_SERVER['PHP_SELF']}'><button>Вывести всё</button></a>";
} else {
    echo <<<'EOD'
    <div style='display: flex;
    margin: 0 auto;
    width: 600px;
    flex-wrap: wrap;
    flex-direction: row;
    align-content: space-around;
    justify-content: space-around;'>
    EOD;     

    for($i=1; $i<=10; $i++){
        echo '<div style="margin: 20px;">';
        echo tableM($i, $arr);
        echo '</div>';
    }
    echo '</div>';
}