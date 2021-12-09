<?php
class ModelConnected{
    public static function deconnexion():void{
        session_unset();
        session_destroy();
        $_SESSION=array();
    }
    public static function isConnected():?user{
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            $id=Validation::validateInt($_SESSION['id']);
            $m=new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            return $m->getUserFromid($id);
        }
        else{
            return	null;
        }	
    }
}
