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
            $arr[]=new Task($t["name"],$t["isDone"],$t["id"]);
        }
        return $arr;
    }
    public function addTask($name, $listId):void{
        $query="insert into task(name,idList) values(:n,:id)";
        $this->con->executeQuery($query,array(':n'=>array($name,PDO::PARAM_STR),':id'=>array($listId,PDO::PARAM_INT)));
    }

    public function updateDone(int $id,bool $value):void{
        $query="UPDATE task SET isDone=:value WHERE task.id = :id";
        $this->con->executeQuery($query,array(':id'=>array($id,PDO::PARAM_INT),':value'=>array($value,PDO::PARAM_BOOL)));
    }
    private $con;
}