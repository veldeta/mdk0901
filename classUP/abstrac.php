<?php

interface UserRole
{
    function showRole();
}

interface Doctor {
    function showClient();
}
interface SportMan {}


abstract class UserMain
{
    public $login;
    public $pass;

    abstract function showInfo();

}

class User extends UserMain implements UserRole, Doctor
{

    public $name;
    public static $countUser = 0;

    public function __construct($name, $login, $password){
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        self::$countUser++;
    }

    public function showRole(){}
    public function showClient(){}

    public function countWorker(){
        return "Всего обычных пользователей: " . self::$countUser;
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
    }

    public function __destruct(){
        echo 'Пользователь ' . $this->name . ' удален <br>';
    }
}


class SuperUser extends User
{
    public $fio;
    public $email;
    public $age;
    public $sex;
    public static $countSuperUser = 0;


    public function __construct($fio, $email, $age, $sex)
    {
        $this->fio = $fio;
        $this->email = $email;
        $this->age = $age;
        $this->sex = $sex;
        self::$countSuperUser++;
    }

    public function countWorker(){
        return "Всего супер-пользователей: " . self::$countSuperUser;
    }

    public function isSex($sex)
    {
        return $this->sex == $sex;
    }

    public function isAge($age)
    {
        return $this->age >= $age;
    }

}


$user1 = new user("Иван", "Halk", "HalkHalk");
$user2 = new user("Петя","Car99","12345");
$user3 = new user("Саша","Crut","Crut123654");
// $user2 = clone $user1;

// $user2->name = "Петя";
// $user2->login = "Car99";
// $user2->password = "12345";

// $user3 = clone $user2;

// $user3->name = "Саша";
// $user3->login = "Crut";
// $user3->password = "Crut123654";


$p1 = new SuperUser('Иван', 'user@user.ru',60,'М');
$p2 = new SuperUser('Маша', 'user@user.ru',18,'Ж');
$p3 = new SuperUser('Женя', 'user@user.ru',20,'М');
// var_dump($p1);
// var_dump($p1->isSex('Ж'));
// echo "<br>";
// var_dump($p1->isAge(18));

// echo $user1->showInfo();
// echo "<br>";
// echo $user2->showInfo();
// echo "<br>";
// echo $user3->showInfo();
// echo "<br>";


echo "Всего обычный пользователей: " . User::$countUser, '<br>';
echo "Всего супер-пользователей: " . SuperUser::$countSuperUser, '<br>';


// class Company {
//     const NAME_PARENT = 'TK';
//     const NAME = 'Google';


//     public function showCompanyName(){
//         return self::NAME;
//     }

//     public function showMainCompanyName(){
//         return self::NAME_PARENT;
//     }
// }
// $company = new Company();

// echo $company->showMainCompanyName() . PHP_EOL;
// echo $company->showCompanyName() . PHP_EOL;
