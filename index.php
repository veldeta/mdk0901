<?php
if($_SERVER['PATH_TRANSLATED']){
    header('Location: '. $_SERVER['SCRIPT_NAME']);
    exit;
}
function toMain(){
    header("Location: {$_SERVER['SCRIPT_NAME']}");
    exit;   
}
function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
        foreach($objs as $obj) {
            is_dir($obj) ? removeDirectory($obj) : unlink($obj);
        }
    }
    rmdir($dir);
}
if($_GET && $_GET['paramet'] != 'action' && $_GET['paramet'] != 'delete'){
    toMain();   
}

if($_GET['paramet'] == 'delete'){
    removeDirectory($_GET['dir']);
    toMain();
}

$uri = __DIR__;
$ur = scandir($uri);

function file_create($namefile,$readme = null){
    $file = fopen($namefile, 'a');
    if($readme){
        fwrite($file, 'main_file: ' . $readme .'.php' . "\n" . $_GET['Htwo'] . "\n" . $_GET['dis']);
    }
    fclose($file);
}
function block($ur, $delete = false){
    $div = '<div class="doc">';
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
            

                   $div .= "<div class='tasks'>";
                        if($arr) {
                            $div .= "<div>";
                            $div .= "<h2>{$arr[1]}</h2>";
                            $div .= "<p>{$arr[2]}</p>";
                            $div .= "</div>";
                            if(!$delete){
                                if(is_file($url)){
                                    $div .= "<a href='{$value}{$pop}'><button>Перейти</button></a>";
                                } else {    
                                    $div .= "<a href='{$value}{$pop}'><button style='cursor: no-drop;' disabled>Перейти</button></a>";
                                }
                            } else {
                                $div .= "<form action='{$_SERVER['PHP_SELF']}' method='get'><input type='hidden' name='paramet' value='delete'><input type='hidden' name='dir' value='{$value}'><input type='submit' name='delete' value='Удалить'></form>";
                            }
                        }
                    $div .= "</div>";
                        
            }
            unset($arr);
            unset($pop);
        }
    }
    $div .= '</div>';
    return $div;
}
if($_GET['buttoncreate']){

    if(strpos($_GET['filename'], '/')){
        $dir = explode('/', $_GET['filename']);
        if(!array_search($dir[0], $ur)){
            mkdir($dir[0]);
            file_create($_GET['filename'] . '.php');
            file_create($dir[0] . '/readme.csv', $dir[1]);
        }
    } elseif(!strpos($_GET['filename'], '/') && !empty($_GET['filedir'])){
        if(!array_search($_GET['filedir'], $ur)){
            mkdir($_GET['filedir']);
            file_create($_GET['filedir'] . '/' . $_GET['filename'] . '.php');
            file_create($_GET['filedir'] . '/readme.csv', $_GET['filename']);
        }
    }
    toMain();
}

?>

<head>
    <link rel='stylesheet' href='acce/style.css'>
</head>
<body>
<form action='<?= $_SERVER['SCRIPT_NAME']?>' method='get'> 
    <div class="right">
        <input  type="hidden" name="paramet" value="action">
        <lable>
            <button class="create" type="submit" name="send" value="sendcreate">Создать</button>
            <button class="delete" type="submit" name="send" value="senddelete">Удалить</button>
        </lable>    
    </div>
    
</form>

<a href="<?= $_SERVER['SCRIPT_NAME']?>"  class="back fix"><button>Назад</button></a>
<?php 
if(!$_GET){
    echo block($ur);

} elseif(!empty($_GET['paramet']) && $_GET['send'] == 'sendcreate') {
    echo <<<FORM
    <form action='{$_SERVER['PHP_SELF']}' method="get" class="blockdiv">
        <span class="red">* Обязательные для заполнения</span>
        <input type="hidden" name="paramet" value="action">
        <div>
            <lable>
                <p><span class="red">*</span> Имя файла или путь к файлу</p>
                <input type="text" name="filename" placeholder="index или world/index" required>
            </lable>
        </div>
        <div>
            <lable>
                <p>Имя дериктории <span class="znak">&#10067;</span></p>
                <input type="text" name="filedir" placeholder="world">
            </lable>
        </div>
        <div>
            <lable>
                <p><span class="red">*</span> Загаловок</p>
                <input type="text" name="Htwo" placeholder="Авторизация" required>
            </lable>
        </div>
        <div>
            <lable>
                <p>Описания</p>
                <textarea name="dis"></textarea>
            </lable>
        </div>
        <div>
            <lable>
                <input type="submit" name="buttoncreate" value="Создать">
            </lable>
        </div>
    </form>
    FORM;

} elseif (!empty($_GET['paramet']) && $_GET['send'] == 'senddelete'){
    echo block($ur, true);
}
?>
</body>
