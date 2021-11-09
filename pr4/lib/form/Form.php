<?php

class Form
{


    private function parametr($form){
        $param = '';
        foreach ($form as $key => $val){
            $param .= $key . "='{$val}' ";
        } 
        return $param;
    }

    public static function Begin($form){
        if(!is_array($form)) throw new Exception("Параметк в Begin был передан не массивом!"); 
        $obj = new self();
        $param = "<form ". $obj->parametr($form) ." >\n";  
        echo $param;      
        return $obj;
    }

    public function input ($form){
        if(!is_array($form)) throw new Exception("Параметк в input был передан не массивом!"); 
        
        $param = "<div>\n   ";
        $param .= "<input ". $this->parametr($form) ." />\n";
        $param .= "</div>\n";        
        
        $this->input = $param; 
        
        return $this;
    } 
    
    public function print($name){
        return $this->$name;
    }

    public function label(){
        $p = explode('><', $this->params);
        $param =  "{$p[0]}>\n<label>\n<{$p[1]} />\n</label>\n<{$p[2]}";
        return $param;
    }

    public function submit ($form){
        if(!is_array($form)) throw new Exception("Параметк в submit был передан не массивом!"); 

        $param = "<div>\r\n    ";
        $param .= "<input type='submit' " . $this->parametr($form) . " />\r\n";
        return $param .= "</div>\r\n";

    }

    public function password ($form){
        if(!is_array($form)) throw new Exception("Параметк в password был передан не массивом!"); 

        $param = "<div>\n   ";
        $param .= "<input  type='password' " . $this->parametr($form) . " />\n";
        return $param.= "</div>\n";
    }

    public function textarea ($form){
        if(!is_array($form)) throw new Exception("Параметк в textarea был передан не массивом!"); 
        if($form['value']){
            $value = array_shift($form);
        }
        $param = "<div>\n   ";
        $param .= "<textarea " . $this->parametr($form) . ">{$value}</textarea>\n";
        return $param .= "</div>\n";
    }
    
    public static function end(){
        echo "</form>\n";
    }
}