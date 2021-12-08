<?php
class gatewayTodolist{
    private $con;
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    //retourne la liste des publique listes
    public function getPublicLists(int $premiere,int $nb):array{
        $arr=[];
        $query="select * from todolist where isPrivate=0 order by name desc limit :premiere, :nb";
        $this->con->executeQuery($query,array(":premiere"=>array($premiere,PDO::PARAM_INT),":nb"=>array($nb,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["idUser"]);
        }
        return $arr;
    }

    //retourne la liste des todoList de l'utilisateur id
    public function getPrivateLists(int $premiere,int $nb, int $userId):array{
        $arr=[];
        $query="select * from todolist where isPrivate=1 and idUser=:id order by name desc limit :premiere, :nb";
        $this->con->executeQuery($query,array(":id"=>array($userId,PDO::PARAM_INT),":premiere"=>array($premiere,PDO::PARAM_INT),":nb"=>array($nb,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["idUser"]);
        }
        return $arr; 
    }

    //retourne le nombre de list publique
    public function getNbPublicLists():int{
        $res=0;
        $query="select count(*) from todolist where isPrivate=0";
        $this->con->executeQuery($query);
        $res=$this->con->getResults();
        return $res[0][0];
    }

    //retourne le nombre de liste privée de l'utilisateur id
    public function getNbPrivateLists(int $userId):int{
        $res=0;
        $query="select count(*) from todolist where isPrivate=1 and idUser=:id";
        $this->con->executeQuery($query,array(":id"=>array($userId,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        return $res[0][0];
    }

    //ajoute une liste a BDD
    public function addList(string $name, bool $isPrivate, int $idUser=NULL):int
    {
        $query="insert into todolist(name,isPrivate,isDone,idUser) values (:n,:p,:d,:id)";
        $this->con->executeQuery($query,array(":n"=>array($name,PDO::PARAM_STR),':p'=>array($isPrivate,PDO::PARAM_BOOL),':d'=>array(0,PDO::PARAM_BOOL),':id'=>array($idUser,PDO::PARAM_INT)));
        $query="select max(id) from todolist";
        $this->con->executeQuery($query);
        $res=$this->con->getResults();
        return $res[0][0];
    }

    public function allTaskDone($idList):bool
    {
        $res=0;
        $query="select count(*) from task where idList=:id and isDone=0";
        $this->con->executeQuery($query,array(":id"=>array($idList,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        return boolval($res[0]["count(*)"])>0?boolval(0):boolval(1);
    }

    //supprime une liste
    public function delList(int $listId):void
    {
        $query="delete from todolist where id=:i";
        $this->con->executeQuery($query,array(":i"=>array($listId,PDO::PARAM_INT)));
    }

    public function getList($idList):todoList{
        $res=0;
        $query="select * from todolist where id=:i";
        $this->con->executeQuery($query,array(":id"=>array($idList,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["idUser"]);
        }
        return $arr[0]; 
    }
}