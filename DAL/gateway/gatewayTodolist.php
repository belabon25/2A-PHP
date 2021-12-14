<?php
class gatewayTodolist{
    private $con;
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    //Retourne la liste des listes publique
    public function getPublicLists(int $premiere,int $nb):array{
        $arr=[];
        $query="select * from todolist where isPrivate=0 order by id limit :premiere, :nb";
        $this->con->executeQuery($query,array(":premiere"=>array($premiere,PDO::PARAM_INT),":nb"=>array($nb,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["userName"]);
        }
        return $arr;
    }

    //Retourne la liste des todoList de l'utilisateur en fonction de son nom.
    public function getPrivateLists(int $premiere,int $nb, string $userName):array{
        $arr=[];
        $query="select * from todolist where isPrivate=1 and userName=:id order by id limit :premiere, :nb";
        $this->con->executeQuery($query,array(":id"=>array($userName,PDO::PARAM_STR),":premiere"=>array($premiere,PDO::PARAM_INT),":nb"=>array($nb,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["userName"]);
        }
        return $arr; 
    }

    //Retourne le nombre de listes publique
    public function getNbPublicLists():int{
        $res=0;
        $query="select count(*) from todolist where isPrivate=0";
        $this->con->executeQuery($query);
        $res=$this->con->getResults();
        return $res[0][0];
    }

    //Retourne le nombre de liste privées de l'utilisateur en fonction de son nom
    public function getNbPrivateLists(string $userName):int{
        $res=0;
        $query="select count(*) from todolist where isPrivate=1 and userName=:id";
        $this->con->executeQuery($query,array(":id"=>array($userName,PDO::PARAM_STR)));
        $res=$this->con->getResults();
        return $res[0][0];
    }

    //Ajoute une liste a BDD
    public function addList(string $name, bool $isPrivate, string $userName=NULL):int
    {
        $query="insert into todolist(name,isPrivate,isDone,userName) values (:n,:p,:d,:id)";
        $this->con->executeQuery($query,array(":n"=>array($name,PDO::PARAM_STR),':p'=>array($isPrivate,PDO::PARAM_BOOL),':d'=>array(0,PDO::PARAM_BOOL),':id'=>array($userName,PDO::PARAM_STR)));
        $query="select max(id) from todolist";
        $this->con->executeQuery($query);
        $res=$this->con->getResults();
        return $res[0][0];
    }

    //Indique si toutes les tâches sont terminées, sert pour l'affichage
    public function allTaskDone($idList):bool
    {
        $res=0;
        $query="select count(*) from task where idList=:id and isDone=0";
        $this->con->executeQuery($query,array(":id"=>array($idList,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        return boolval($res[0]["count(*)"])>0?boolval(0):boolval(1);
    }

    //Supprime une liste selon son ID
    public function delList(int $listId):void
    {
        $query="delete from todolist where id=:i";
        $this->con->executeQuery($query,array(":i"=>array($listId,PDO::PARAM_INT)));
    }

    //Récupére une liste en fonction de son ID
    public function getList($idList):todoList{
        $res=0;
        $query="select * from todolist where id=:i";
        $this->con->executeQuery($query,array(":id"=>array($idList,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        foreach($res as $list){
            $arr[]=new todoList($list["id"],$list["name"],$list["isPrivate"],$list["isDone"],$list["userName"]);
        }
        return $arr[0]; 
    }
}