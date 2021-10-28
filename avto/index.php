<?php

// class User
// {
//     public $age;
//     private $role = 'user';
//     protected $passport = 'passport';

//     // public function getAge(){
//     //     return $this->age;
//     // }
// }

// class SuperUser extends User
// {
//     public function getAge(){
//         return $this->age;
//     }
    
//     public function getRole(){
//         return $this->role;
//     }
    
//     public function getPassport(){
//         return $this->passport;
//     }
// }

// $user = new SuperUser();
// $user0 = new User();
// $user0->role = 'admin';
// $user->age = 10;
// echo $user->getAge();
// echo $user->getRole();
// echo $user->getPassport();

// var_dump($user);


use lib\User;
use lib\SuperUser;

require_once 'data/avto.php';

// for($i= 0; $i < 10; $i++){
//     $param[] = ["User{$i}" => new User ("Иван", "Halk", "HalkHalk"), "SuperUser{$i}" => new SuperUser("Иван", "Halk", "HalkHalk","Иван","user@user.ru", 20, "Male")];
// }

for($i= 0; $i < 10; $i++){
    $user = "user{$i}";
    $$user = new User ("Иван", "Halk", "HalkHalk");
    $superUser = "superUser{$i}";
    $$superUser = new SuperUser("Иван", "Halk", "HalkHalk","Иван","user@user.ru", 20, "Male");
}

echo $user0->getPsw(), "<br>";

$superUser2->setCount();
echo $superUser2->getCount(), "<br>";



echo "Всего обычных пользователей: " . User::$num;
echo "<br>";
echo "Всего супер-пользователей: " . SuperUser::$num2;
