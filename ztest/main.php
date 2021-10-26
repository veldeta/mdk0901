<form action="<?$_SERVER['PHP_SELF']?>" method='post'>
   <input type="date" name='date'>
   <input type="text" name='name'>
   <input type="submit">
</form>
<?php

// $n = require_once 'db.php';
var_dump($_POST);
$data = $_POST;

abstract class Validet 
{
   public $data;

   abstract function cleaning($date);
}

interface ValidetIN
{
   function pswd();
   function age();
}

class ValidetSite extends Validet
{
   public function cleaning($data){
      foreach ($data as &$val){
         $val = trim(strip_tags($val));
      }
      return $data;
   }
}

$obj = new ValidetSite();
var_dump($obj->cleaning($data));

// if ($data) {
//    $do = new DateTime(date('Y-m-d'));
//    $date_if = new DateTime($data['date']);
//    $d = $date_if->diff($do)->format('%Y');
//    if ($d >= 18) {
//        // unset($_SESSION['data']['date']);
//        // $_SESSION['error'] = ['age' => 'Минимальный возраст для регистрации 18 лет.'];
//        // header("location: {$_SERVER['PHP_SELF']}" . REGISTRATION);
//        // exit;
//    }
// }

die;

class M 
{
   public $name;
   public $argv = false;
   private static $dbname;

   function __construct($name){
      $this->name = $name;
      self::$dbname = require_once 'db.php';
   }

   public function Mm($age){
      if($age > 1){
         $this->dMm();
      }
   }
   
   private function dMm(){
      var_dump(self::$dbname);
      var_dump(!$this->name['d']);
   }
}
$mm = new M(['dd'=>'dd','dd2' => 'dasd', 'd' => 'asd']);
$mm->argv = true;

$mm->Mm(2);
var_dump($mm);
// var_dump($n);



