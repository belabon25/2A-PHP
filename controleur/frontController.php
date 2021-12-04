<?php
class FrontController{
    public function __construct(){
        $listeAction_Admin =array('deconnexion','connected');
        if (isset($_GET['action'])) {
            try{
                if(in_array($_GET['action'],$listeAction_Admin) || isset($_SESSION['id'])){	
                    new	ControllerConnected($_GET['action']);
                }
                else {
                    new	ControllerUser($_GET['action']);
                }
            }catch(Exception $e){
                require $vues['error'];
            }
        }
        else {
            isset($_SESSION['id'])?new ControllerConnected(""):new ControllerUser("");
        }
       
    }
}