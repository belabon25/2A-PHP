<?php
class FrontController{
    public function __construct(){
        session_start();
        $listeAction_Admin =array('deconnexion');
        if (isset($_GET['action'])) {
            try{
                if(in_array($_GET['action'],$listeAction_Admin)){	
                    new	ControllerConnected($_GET['action']);
                }
                else {
                    new	ControllerUser($_GET['action']);
                }
            }catch(Exception $e){
                require $GLOBALS["vues"]['error'];
            }
        }
        else {
            try{
                new	ControllerUser("");
            }catch(Exception $e){
                require $GLOBALS["vues"]['error'];
            }
        }       
    }
}