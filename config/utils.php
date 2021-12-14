<?php
$dir=__DIR__.'/../';
$dsn="mysql:host=localhost;dbname=dbyogourves";//$dsn="mysql:host=berlin.iut.local;dbname=dbyogourves";
$user="yogourves";
$passwd="achanger";

//Chargement des vues
$vues['error']=$dir.'vues/error.php';
$vues['vueTaskPublic']=$dir.'vues/vueTaskPublic.php';
$vues['vueTaskPrivee']=$dir.'vues/vueTaskPrivee.php';
$vues['vueConnexion']=$dir.'vues/vueConnexion.php';
$vues['vueInscription']=$dir.'vues/vueInscription.php';
$vues['vueEnTete']=$dir.'vues/vueEnTete.php';
$vues['vueTaskPriveeNonCo']=$dir.'vues/vueTaskPriveeNonCo.php';
$vues['vueAddList']=$dir.'vues/vueAddList.php';

//Utilisateurs de test :

//Pseudo : Testeur
//Mot de passe : 0000

//Pseudo : Testeur2
//Mot de passe : 0000