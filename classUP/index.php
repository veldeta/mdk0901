<?php 

// class help{

//     public function __construct(){
//         echo 'OK<br>';
//     }

//     public function __destruct(){
//         echo 'Я удалил все!';
//     }
// }

// $user5 = new help();



class user{

    public $name;
    public $login;
    public $password;
    
    public function __construct($name, $login, $password){
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }

    public function showInfo(){
        return <<<DATE
        Имя: {$this->name}
        Логин: {$this->login}
        Пароль: {$this->password}
        DATE;
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
    
    public function __construct($fio, $email, $age){
        $this->fio = $fio;
        $this->email = $email;
        $this->age = $age;
        $this->sex = $sex;
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


}



$user1 = new user("Иван", "Halk", "HalkHalk");

$user2 = clone $user1;

$user2->name = "Петя";
$user2->login = "Car99";
$user2->password = "12345";

$user3 = clone $user2;

$user3->name = "Саша";
$user3->login = "Crut";
$user3->password = "Crut123654";


// $user2 = new user("Петя","Car99","12345");
// $user3 = new user("Саша","Crut","Crut123654");



echo $user1->showInfo();
echo "<br>";
echo $user2->showInfo();
echo "<br>";
echo $user3->showInfo();
echo "<br>";




