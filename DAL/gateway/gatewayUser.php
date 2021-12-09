<?php

class gatewayUser{
    private $con;
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    //retourne l'utilisateur correspondant au couple userName/passwdHash
    public function getUser(string $userName):user{
        $query="select * from user where name=:n";
        $this->con->executeQuery($query,array(':n'=>array($userName,PDO::PARAM_STR)));
        $res=$this->con->getResults()[0];
        if($res["id"]==NULL){
            return new User(-1,"");
        }
        return new user($res["id"],$res["name"]);
    }

    //retourne le hash du password apparrtenant a l'utilisateur username
    public function getHashedPasswd(string $userName):string{
        $query="select hashPasswd from user where name=:n";
        $this->con->executeQuery($query,array(':n'=>array($userName,PDO::PARAM_STR)));
        $res=$this->con->getResults()[0];
        if(sizeof($res)==0){
            return "";
        }
        return $res[0];
    }

    //retourne l'utilisateur correspondant a l'id 'userid'
    public function getUserFromid(int $userId):user{
        $query="select * from user where id=:id";
        $this->con->executeQuery($query,array(':id'=>array($userId,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        if(sizeof($res)==0){
            throw new ErrorException("Id Invalide");
            return NULL;
        }
        return new user($res["id"],$res["name"]);
    }

    //ajoute le user passé en parametre
    public function addUser(string $userName, string $passwd):void{
        $query="insert into user values(NULL, :n,:p)";
        $this->con->executeQuery($query,array(':n'=>array($userName,PDO::PARAM_STR),':p'=>array($passwd,PDO::PARAM_STR)));
    }
}