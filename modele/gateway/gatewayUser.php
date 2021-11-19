<?php

class gatewayUser{
    private $con;
    public function __construct(string $dsn, string $user, string $passwd){
       $con=new Connection($dsn,$user,$passwd); 
    }

    public function getUserId(string $userName, string $passwdHash){
        
    }
}