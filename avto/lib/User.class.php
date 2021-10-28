<?php

namespace lib;

class User
{

    public $name;
    public $login;

    private $password = "null";

    protected $passport = 'passport';

    public static $num;
    
    public function __construct($name, $login, $password){
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        self::$num++;
    }

    public function getPsw(){
        return $this->password;
    }
    
    public function setPsw(){
        $this->password = '12345678';
    }
    
    public function getPassport(){
        return $this->passport;
    }
    
    public function setPassport(){
        $this->passport = 'multipassport';
    }

    public function showInfo(){
        return <<<DATA
        Имя: {$this->name}
        Логин: {$this->login}
        Пароль: {$this->password}
        DATA;
    }
    public function __clone(){
        echo 'Этот пользователь ' . $this->name . ' склонирован <br>';
        self::$num++;
    }

}