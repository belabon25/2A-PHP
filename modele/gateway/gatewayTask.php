<?php

class gatewayTask{
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    public function getTasks(int $listId):array{
        $arr=[];
        $query="select * from task where idList=:i";
        $this->con->executeQuery($query,array(':i'=>array($listId,PDO::PARAM_INT)));
        $res=$this->con->getResults();        
        foreach($res as $t){
            $arr[]=new Task($t["name"]);
        }
        return $arr;
    }
    public function addTask($name, $listId):void{
        $query="insert into task(name,idList) values(:n,:id)";
        $this->con->executeQuery($query,array(':n'=>array($name,PDO::PARAM_STR),':id'=>array($listId,PDO::PARAM_INT)));
    }
    private $con;
}