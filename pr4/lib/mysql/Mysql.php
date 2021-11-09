<?php 

class MySql 
{

    private $db;
    private $connect = false;

    function __construct($db){
        @$this->db = new mysqli($db['host'],$db['user'],$db['pass'],$db['dbname']);

        if(!$this->db->connect_error){
            $this->connect = true;    
        } else {
            throw new Exception('Нет подключения: ' . $this->db->connect_errno. ' -> ' . $this->db->connect_error);
        }
        
    }
    
    public function connected(){
        return $this->connect;
    }

    public function stmt($mass){
        if(empty($mass['query'])) throw new Exception('Не был передан sql-запрос');

        $stmt = $this->db->prepare($mass['query']);

        if(!$stmt) throw new Exception("Объект не был создан, произошла ошибка");

        return $this->BindParam($stmt, $mass);
    }

    private function BindParam($stmt, $mass){
        if(empty($mass)) throw new Exception('Массив пустой');

        // if(!$mass['data_answer']) 
        //     throw new Exception('Массив был передан без следующий ключей: ');
        
        if($mass['data_stmt']){
            if(is_array($mass['data_stmt'])){
                $stmt->bind_param($mass['type'], ...$mass['data_stmt']);
            } else {
                $stmt->bind_param($mass['type'], $mass['data_stmt']);
            }
        }
        
        if($mass['answer']){
            $res = $this->BindResult($stmt, $mass);
        } elseif($mass['all']) {

            if($this->stmtExecute($stmt)){
                $result = $stmt->get_result();
                while ($row = $result->fetch_array(MYSQLI_NUM)) {
                    $res[] = $row;
                }
            }
        } else {
            $res = $this->stmtExecute($stmt);
        }
        
        
        $stmt->close();

        return $res;
    }

    private function BindResult($stmt, $mass){
        $row = [];
        foreach ($mass['data_answer'] as $val) {
            $param[] = &$row[$val];
        }

        call_user_func_array(array($stmt, 'bind_result'), $param);
        

        if(!$this->stmtExecute($stmt)) throw new Exception('Запрос не выполнился');
        if(!$this->stmtFetch($stmt)) throw new Exception('Данные не были распихнуты в переменные');


        return $param;
    }

    private function stmtExecute($stmt){
        return $stmt->execute();
    }

    private function stmtFetch($stmt){
        return $stmt->fetch();
    }

    public function  myClose(){
        $this->db->close();
    }
}
