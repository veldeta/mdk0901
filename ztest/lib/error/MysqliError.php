<?php

namespace error;

class MysqliError extends Exception
{
    public $error;
    public $errno;

    function __construct($message, $error, $errno){
        $this->error = $error;
        $this->errno = $errno;
        $message .= errorMessage();
        parent::__construct($message);
    }
    
    public function errorMessage(){
        return "<br>Ошабка: " . $this->error . '<br>' . "Код ошибки: " . $this->errno;
    }
}

class ArrData extends Exception
{

    function __construct($message, $mass){
        $this->mass = $mass;
        $message .= NoData();
        parent::__construct($message);
    }

    public function NoData(){
        $mess = " ";
        if(!$this->mass['data_stmt']) $mess .= "data_stmt, ";
        if(!$this->mass['type']) $mess .= "type, ";
        if(!$this->mass['data_answer']) $mess .= "data_answer";
        return $mess;
    }

}