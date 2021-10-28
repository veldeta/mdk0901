<?php
namespace config;

require_once '../error/MysqliError.php';

use error\MyError;

class MysqliSlava 
{

    private static $db;

    function __construct(){
        self::$db = require_once 'db.php';
    }

    public function myOpen(){
        $mysqli = new mysqli(self::$db['host'], self::$db['user'], self::$db['password'], self::$db['dbname']);
        if($mysqli->connect_error()){
            throw new MyError("Не Удалось подключиться к базе данных.", $msqli->error, $msqli->errno);
        }
        return $mysqli;
    }

    public function myClose($mysqli){
        $mysqli->close();
    }
}

class MyStmt extends MysqliSlava
{
    public $query;
    public $mass;
    public $answer = false;

    function __construct($query, $mass){
        $this->query = $query;
        $this->mass = $mass;
    }

    public function stmt($mysqli){
        if(!empty($this->query)) throw new Exception('Не был передан sql-запрос');
            
        $stmt = $msqli->prepare($this->query);

        if(!$stmt) throw new Exception("Объект не был создан, произошла ошибка");
            
        return BindParam($stmt);
    }

    private function BindParam($stmt){
        if(empty($this->mass)) throw new Exception('Массив пустой');

        if(!$this->mass['data_stmt'] && !$this->mass['type'] && !$this->mass['data_answer']) 
            throw new ArrData('Массив был передан без следующий ключей: ',$this->mass);

        if(is_array($this->mass['data_stmt'])){
            $stmt->bind_param($this->mass['type'], ...$this->mass['data_stmt']);
        } else {
            $stmt->bind_param($this->mass['type'], $this->mass['data_stmt']);
        }
        
        if($answer){
            $res = BindResult($stmt);
        } else {
            $res = stmtExecute($stmt);
        }

        $stmt->close();

        return $res;
    }

    private function BindResult($stmt){

        foreach ($this->mass['data_answer'] as $key => $val) {
            $param[] = &$row[$key];
        }
        call_user_func_array(array($stmt, 'bind_result'), $param);
        
        stmtExecute($stmt);

        return stmtFetch($stmt);
    }

    private function stmtExecute($stmt){
        return $stmt->execute();
    }

    private function stmtFetch($stmt){
        return $stmt->fetch();
    }
}