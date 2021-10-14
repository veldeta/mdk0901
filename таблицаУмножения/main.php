<?php

if($_SERVER['PATH_INFO']){
    header('location: '. $_SERVER['SCRIPT_NAME']);   
    exit;
}

function tableM($arr, $page = false){
    if($page){
        $num  = $page + 1;
        $_i = $page;
    } else {
        $num  = 11;
        $_i = 1;
    }
    
    $div = <<<'EOD'
    <div style='display: flex;
    margin: 0 auto;
    width: 600px;
    flex-wrap: wrap;
    flex-direction: row;
    align-content: space-around;
    justify-content: space-around;'>
    EOD;
    for($i = $_i; $i < $num; $i++){
        $div .= '<div style="margin: 20px;">';
        for($j=1; $j<=10; $j++){
            $x = (in_array($i, $arr)) ? "<a href='{$_SERVER['PHP_SELF']}?page=".$i."'>{$i}</a>" : $i;
            $y = (in_array($j, $arr)) ? "<a href='{$_SERVER['PHP_SELF']}?page=".$j."'>{$j}</a>" : $j;
            $div .= '<li style="list-style-type: none">' . $x . ' * ' . $y . ' = ' . $i*$j . '</li>';
        }
        $div .= '</div>';
    }   
    $div .= '</div>';
    return $div;
}

$arr = range(2,9);

if(isset($_GET['page'])){
    if(!in_array($_GET['page'], $arr) || strlen($_GET['page']) > 1){
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

$page = $_GET['page'];

if($page){
    echo tableM($arr, $page);
    echo "<a href='{$_SERVER['PHP_SELF']}'><button>Вывести всё</button></a>";
} else {
    echo tableM($arr),'</div>';
}