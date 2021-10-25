<?php

class E1 extends Exception{
    function __construct($message){
        $message .= ' ' . $this->someMethod();
        parent::__construct($message);
    }   
    public function someMethod(){
        return __CLASS__;
    }
}

class E2 extends Exception{
    function __construct($message){
        $message .= ' '. $this->someMethod();
        parent::__construct($message);
    }   
    public function someMethod(){
        return __CLASS__;
    }
}

function main(){
    $x = rand(0,20);
    return one($x);
}
function one($x){
    if($x == 0){
        throw new E1('erroe x = 0');
    }
    return two($x);
}
function two($x){
    if($x < 5){
        throw new E2('erroe x < 5');
    
    }
    return three($x);
}
function three($x){
    if($x > 15){
        throw new Exception('erroe x > 15');
    }
    return $x;
}
try{
    echo main();
} catch(E1 | E2 | Exception $e){
    echo $e->getMessage();
}