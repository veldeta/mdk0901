<?php

class Session
{
    function __construct(){
        session_start();
    }

    public function setSession($session, $value){
        $_SESSION[$session] = $value;
    }
    public function getSession($session){
        return $_SESSION[$session];
    }
    public function delSession($session){
        unset($_SESSION[$session]);
    }
    public function notNullSession($session){
        return $_SESSION[$session] ? true : false;
    }
}