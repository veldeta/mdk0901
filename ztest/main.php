<?php

// $n = require_once 'db.php';

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