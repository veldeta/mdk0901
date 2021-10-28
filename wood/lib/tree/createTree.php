<?php

class createTree
{
    public $tree;
    public static $count = 1;

    public function setcount(){
        return self::$count++;
    }
    
    public function getcount(){
        return self::$count;
    }
    
    public function create($tree, $coun = null){

        // $m = "INSERT INTO tree (title, expansion_id, parent_id) VALUES ";

        if($tree){
            foreach($tree as $key => $val){
                
                if(is_array($val)){
                    $this->setcount();
                    $this->create($val);
                }
                // var_dump($val);
                if(!is_array($val)){
                    $this->setcount();
                }
                // var_dump($key);
                // var_dump($val);

            }
        }

        return $tree;
    } 
}