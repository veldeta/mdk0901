<?php
/*
class user{

    public $name;
    public $login;
    public $password;

    public static $num;
    
    public function __construct($name, $login, $password){
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        self::$num++;
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

class SuperUser extends User 
{
    public $fio;
    public $email;
    public $age;
    public $sex;
    
    public static $num2;

    public function __construct($name, $login, $password, $fio, $email, $age){
        $this->fio = $fio;
        $this->email = $email;
        $this->age = $age;
        $this->sex = $sex;
        self::$num2++;
        parent::__construct($name, $login, $password);
        parent::$num--;
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

$user1 = new user("Иван", "Halk", "HalkHalk");
$user11 = clone $user1;
$user2 = new user("Петя","Car99","12345");
$user3 = new user("Саша","Crut","Crut123654");


$SuperUser1 = new SuperUser("Иван", "Halk", "HalkHalk","Иван","user@user.ru", 20, "Male");
$SuperUser2 = new SuperUser("Петя","Car99","12345","Иван","user@user.ru", 20, "Male");
$SuperUser3 = new SuperUser("Саша","Crut","Crut123654","Иван","user@user.ru", 20, "Male");
$SuperUser4 = new SuperUser("Петя","Crut","HalkHalk","Иван","user@user.ru", 20, "Male");

$SuperUser1->age = 18;
$SuperUser1->sex = 'Female';

$SuperUser2->age = 18;
$SuperUser2->sex = 'Male';

$SuperUser3->age = 18;
$SuperUser3->sex = 'Female';

$SuperUser4->age = 18;
$SuperUser4->sex = 'Male';

echo "Всего обычных пользователей: " . User::$num;
echo "<br>";
echo "Всего супер-пользователей: " . SuperUser::$num2;
*/

function __autoload($class){
    echo 'ok';
}


// class Calc
// {
//     const PI = M_PI;

//     static function calc_len($r){
//         return 2 * $r * self::PI;
//     }
// }

$o = new Calc();

// echo Calc::calc_len(10);
// echo Calc::PI;

