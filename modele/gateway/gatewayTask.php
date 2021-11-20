<?php

class gatewayTask{
    
    public function __construct(string $dsn, string $user, string $passwd){
       $this->con=new Connection($dsn,$user,$passwd); 
    }

    public function getPublicTask():array{
        $arr=[];
        $query="select * from tache where isPrivate=0";
        $this->con->executeQuery($query);
        $res=$this->con->getResults();        
        foreach($res as $t){
            $arr[]=new Task($t["name"],$t["description"],date("m/d/y"),date("m/d/y"));
        }
        return $arr;
    }
    private $con;
}