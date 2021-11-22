<?php

class gatewayTask{
    
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    public function getTask(int $listId):array{
        $arr=[];
        $query="select * from task where idList=:i";
        $this->con->executeQuery($query,array(':i'=>array($listId,PDO::PARAM_INT)));
        $res=$this->con->getResults();        
        foreach($res as $t){
            $arr[]=new Task($t["name"],$t["description"]);
        }
        return $arr;
    }
    private $con;
}