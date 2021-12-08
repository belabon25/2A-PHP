<?php

class Validation {

    //valide la valeur de page, page doit etre compris entre 1 et nbElement/element par page
    static function validatePageNb(int $page, int $nbElement, int $elemParPage):int{
        if(!filter_var($page,FILTER_VALIDATE_INT,array("options" => array("min_range"=>1, "max_range"=>($nbElement/$elemParPage)))) === false){
            return 1;  
        }
        else {
            return $page;
        }
    }


    //prend en reference le nom de la tache ainsi que ses tache pour les sanitize
    static function validateFormNewList(string &$nom, array &$taches){ 
        $nom=filter_var($nom,FILTER_SANITIZE_STRING);
        foreach ($taches as &$t) {
            $t=filter_var($t,FILTER_SANITIZE_STRING);
        }
    }

    //prend en reference le username et le password pour les sanitize
    static function validateUser(string &$username, string &$password){
        $username=filter_var($username,FILTER_SANITIZE_STRING);
        $password=filter_var($password,FILTER_SANITIZE_STRING);
    }

    static function validateInt(int $number){
        return filter_var($number,FILTER_SANITIZE_NUMBER_INT);
    }
}