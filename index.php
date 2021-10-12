<head>
    <link rel='stylesheet' href='acce/style.css'>
</head>
<?php 
$uri = $_SERVER['DOCUMENT_ROOT'];
$ur = scandir($uri);
echo '<div class="doc">';
foreach($ur as $value){
    $arr[1] = $value;
    $arr[2] = 'Этот блок находиться в стадии разработки.';
    $url = "{$value}/readme.csv";
    $v = '/' . $value;
    if($value != '.' && $value != '..' && $v != $_SERVER['SCRIPT_NAME'] && $value != 'acce'){
        if(is_dir($value)){
            if(is_file($url)){
                $arr = file($url);
                $a = explode(':',$arr[0]);
                $pop = '/'. trim($a[1]);
            }
          
?>
                <div class="tasks">
                    <? if($arr) : ?>
                    
                        <div>
                            <h2><?=$arr[1]?></h2>
                            <p><?=$arr[2]?></p>
                        </div>
                        <? if(is_file($url)) : ?>
                            <a href="<?= $value . $pop?>"><button>Перейти</button></a>
                        <? else : ?>    
                            <a href="<?= $value . $pop?>"><button style="cursor: no-drop;" disabled>Перейти</button></a>
                        <? endif ?>
                    <? endif ?>
                </div>
<?  
            
        }
        unset($arr);
        unset($pop);
    }
}
echo '</div>';
?>
