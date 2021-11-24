<?php

class userModel{
    private $gtUser;
    public function __construct(string $dsn, string $user, string $passwd){
        $this->gtUser=new gatewayUser($dsn,$user,$passwd);
    }
    public function getUser(string $userName, string $passwdHash):user{
        return $this->gtUser->getUser($userName,$passwdHash);
    }
    public function getUserFromid(int $userId):user{
        return $this->gtUser->getUserFromid($userId);
    }
}