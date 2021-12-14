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
        if($res["name"]==NULL){
            return new User("","");
        }
        return new user($res["name"],"connected");
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

    //ajoute le user passé en parametre
    public function addUser(string $userName, string $passwd):void{
        $query="insert into user values(:n,:p)";
        $this->con->executeQuery($query,array(':n'=>array($userName,PDO::PARAM_STR),':p'=>array($passwd,PDO::PARAM_STR)));
    }
}