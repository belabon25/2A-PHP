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
    public function addUser(string $userName, string $passwd):void{
        $this->gtUser->addUser($userName,$passwd);
    }
    public function connection(string $name, string $passwd):void{
        $user=$this->getUser($name,$passwd);
        if ($user==NULL) {
            return;//vue erreur?
        }
        $_SESSION['id']=$user->getId();
        $_SESSION['role']='connected';
    }
    public static function deconnexion():void{
        session_unset();
        session_destroy();
        $_SESSION=array();
    }
}