<?php
class ModelConnected{
    public static function deconnexion():void{
        session_unset();
        session_destroy();
        $_SESSION=array();
    }
    public static function isConnected():?user{
        if(isset($_SESSION['name']) && isset($_SESSION['role'])){
            $name=Validation::validateStr($_SESSION['name']);
            $m=new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            return $m->getUser($name);
        }
        else{
            return	null;
        }	
    }

    public function connection(string $name, string $passwd):bool{
        $gtUser=new gatewayUser($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        if(password_verify($passwd, $gtUser->getHashedPasswd($name))){
            $user=$gtUser->getUser($name);
            if ($user->getName()=="") {
                return false;
            }
            $_SESSION['name']=$user->getName();
            $_SESSION['role']=$user->getRole();
            return true;
        }
        return false;
    }
}
