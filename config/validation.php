<?php

class Validation {
    static function validatePageNb(int $page, int $nbElement, int $elemParPage):int{
        if(filter_var($page,FILTER_VALIDATE_INT,array("options" => array("min_range"=>1, "max_range"=>($nbElement/$elemParPage)))) === false){
            return 1;  
        }
        else {
            return $page;
        }
    }

    static function validateFormNewList(string &$nom, array &$taches){ 
        $nom=filter_var($nom,FILTER_SANITIZE_STRING);
        foreach ($taches as &$t) {
            $t=filter_var($t,FILTER_SANITIZE_STRING);
        }
    }

    static function validateUser(string &$username, string &$password){
        $username=filter_var($username,FILTER_SANITIZE_STRING);
        $password=filter_var($password,FILTER_SANITIZE_STRING);
    }
}