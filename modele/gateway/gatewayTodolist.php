<?php
class gatewayTodolist{
    private $con;
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    public function getPublicLists(int $page,int $nb):array{
        $arr=[];
        $query="select * from todolist where isPrivate=0 order by name desc limit :page, :nb";
        $this->con->executeQuery($query,array(":page"=>array($page,PDO::PARAM_INT),":nb"=>array($nb,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["idUser"]);
        }
        return $arr;
    }

    public function getPrivateLists(int $page,int $nb, int $userId):array{
        $arr=[];
        $query="select * from todolist where isPrivate=1 and userId=:id order by name desc limit (:page -1) , :nb";
        $this->con->executeQuery($query,array(":id"=>array($userId,PDO::PARAM_INT),":page"=>array($page,PDO::PARAM_INT),":nb"=>array($nb,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["idUser"]);
        }
        return $arr; 
    }

    public function getNbPublicLists():int{
        $res=0;
        $query="select count(*) from todolist where isPrivate=0";
        $this->con->executeQuery($query);
        $res=$this->con->getResults();
        return $res[0][0];
    }

    public function getNbPrivateLists(int $userId):int{
        $res=0;
        $query="select count(*) from todolist where isPrivate=1 and userId=:id";
        $this->con->executeQuery($query,array(":id"=>array($userId,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        return $res[0][0];
    }
}