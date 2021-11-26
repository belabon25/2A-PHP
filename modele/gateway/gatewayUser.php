<?php

class gatewayUser{
    private $con;
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    public function getUser(string $userName, string $passwdHash):user{
        $query="select * from user where name=:n and hashPasswd=:h";
        $this->con->executeQuery($query,array(':n'=>array($userName,PDO::PARAM_STR),':h'=>array($passwdHash,PDO::PARAM_STR)));
        $res=$this->con->getResults()[0];
        if($res["id"]==NULL){
            throw new ErrorException("Username or password invalid");
            return NULL;
        }
        return new user($res["id"],$res["name"]);
    }

    public function getUserFromid(int $userId):user{
        $query="select * from user where userId=:id";
        $this->con->executeQuery($query,array(':id'=>array($userId,PDO::PARAM_INT)));
        $res=$this->con->getResults();
        if(sizeof($res)==0){
            throw new ErrorException("Id Invalide");
            return NULL;
        }
        return new user($res["id"],$res["name"]);
    }
}