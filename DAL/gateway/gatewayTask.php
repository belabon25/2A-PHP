<?php

class gatewayTask{
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    //retourne la tache ayant pour id de liste listId
    public function getTasks(int $listId):array{
        $arr=[];
        $query="select * from task where idList=:i";
        $this->con->executeQuery($query,array(':i'=>array($listId,PDO::PARAM_INT)));
        $res=$this->con->getResults();        
        foreach($res as $t){
            $arr[]=new Task($t["name"],$t["isDone"],$t["id"]);//creation du tableau de tache de la liste
        }
        return $arr;
    }

    //ajoute une tache a la BDD
    public function addTask($name, $listId):void{
        $query="insert into task(name,idList) values(:n,:id)";
        $this->con->executeQuery($query,array(':n'=>array($name,PDO::PARAM_STR),':id'=>array($listId,PDO::PARAM_INT)));
    }

    //modifie la valeur done de la tache d'id 'id' a la valeur 'value'
    public function updateDone(int $id,bool $value):void{
        $query="UPDATE task SET isDone=:value WHERE task.id = :id";
        $this->con->executeQuery($query,array(':id'=>array($id,PDO::PARAM_INT),':value'=>array($value,PDO::PARAM_BOOL)));
    }


    //delete task d'id 'taskId'
    public function delTask(int $taskId)
    {
        //TODO
    }

    private $con;
}