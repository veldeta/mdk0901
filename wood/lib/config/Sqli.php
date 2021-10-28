<?php

class Sqli 
{

    private $db;
    private $connect = false;

    function __construct($db){
        $this->db = new mysqli($db['host'],$db['user'],$db['pass'],$db['dbname']);

        if(!$this->db->connect_error){
            $this->connect = true;    
        } else {
            throw new Exception('Нет подключения: ' . $this->db->connect_errno. ' -> ' . $this->db->connect_error);
        }
        
    }

    public function connected(){
        return $this->connect;
    }

    public function  myClose(){
        $this->db->close();
    }
}