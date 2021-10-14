<?php
// echo $_SERVER['REQUEST_URI'];


if($_SERVER['PATH_TRANSLATED']){
   header("location: {$_SERVER['SCRIPT_NAME']}");
   exit;
}
var_dump($_SERVER);
var_dump($_GET);
echo "<a href='{$_SERVER['REQUEST_URI']}/'>{$_SERVER['PHP_SELF']}</a>";
