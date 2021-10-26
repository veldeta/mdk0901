<?php
namespace validetion;

abstract class Validet 
{
    public $data;
    abstract function cleaning($date);
}

interface ValidetIN{
    function pswd();
    function age();
}

class ValidetSite extends Validet 
{
    public function cleaning($data){
        if(empty($date)) throw new Exception('Массив данных был передан пустым');

        foreach ($data as &$val){
            $val = trim(strip_tags($val));
        }
        return $data;
    }
}

class RegValidet extends ValidetSite implements ValidetIN
{
    public function pswd($data){

        if($data['pass'] != $data['pass2']){
            $error = ['pass' => 'Пароли не совпадают, введите коректный пароль.'];
        }
        
        if(strlen($data['pass'] < 8)){
            $error = ['pass' => 'Пароль должен быть не менее 8 символов.'];
        }

        return $this->age($data);
    }

    public function age($data){
        $do = new DateTime(date('Y-m-d'));
        $date_if = new DateTime($data['date']);
        $date = $date_if->diff($do)->format("%Y");

        if ($date >= AGE) {
            $error = ['age' => 'Минимальный возраст для регистрации 18 лет.'];        
        }
        return $error ?? true;
    }
}
