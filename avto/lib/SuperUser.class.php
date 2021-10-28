<?php

namespace lib;

class SuperUser extends User 
{
    public $fio;
    public $email;
    public $age;
    public $sex;

    public static $num2;

    private static $count = 0;

    protected $obj;

    public function __construct($name, $login, $password, $fio, $email, $age){
        $this->fio = $fio;
        $this->email = $email;
        $this->age = $age;
        $this->sex = $sex;
        self::$num2++;
        parent::__construct($name, $login, $password);
        parent::$num--;
    }

    public function getCount(){
        return self::$count;
    }
    
    public function setCount(){
        self::$count++;
    }
    
    public function getObject(){
        return $this->$obj = new User();
    }
    
    public function setObject(){
        $this->$obj->name = "John";
    }

    public function showSex()
    {
        if($this->sex == 'Male'){
            echo $this->sex;
        } elseif($this->sex == 'Female'){
            echo $this->sex;
        }
    }

    public function showAge(){
        if(18 == $age){
            echo 'Пройдет';
        } 
    }

    public function __clone(){
        self::$num2++;
    }

}