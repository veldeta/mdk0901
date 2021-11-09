<?php

class Cookie
{
    private $cook = false;

    public function set($namecookie, $value){
        setcookie($namecookie, $value, time()+ 3600*24*30);
    }

    public function get($namecookie){
        if($_COOKIE[$namecookie]){
            $this->cook = true;
        }
        return $this->cook;
    }

    public function del($namecookie){

        setcookie($namecookie, '' , time()-1);

    }

}