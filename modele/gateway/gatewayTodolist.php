<?php
class gatewayTodolist{
    private $con;
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    public function getAllPublicLists():array{
        $arr=[];
        $query="select * from todolist where isPrivate=0";
        $this->con->executeQuery($query);
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["idUser"]);
        }
        return $arr;
    }
}