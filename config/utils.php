<?php
$dir=__DIR__.'//..//';
$dsn="mysql:host=localhost;dbname=dbyogourves";//$dsn="mysql:host=berlin.iut.local;dbname=dbyogourves";
$user="yogourves";
$passwd="achanger";

//require
require($dir.'controleur/connection.php');
require($dir.'modele/gateway/gatewayTask.php');
require($dir.'modele/gateway/gatewayUser.php');
require($dir.'modele/gateway/gatewayTodolist.php');
require($dir.'modele/todoList.php');
require($dir.'modele/task.php');
require($dir.'modele/user.php');

//vues
$vues['error']=$dir.'vues/erreur.php';
$vues['vueTaskPublic']=$dir.'vues/vueTaskPublic.php';
$vues['vueTaskPrivee']=$dir.'vues/vueTaskPrivee.php';
$vues['vueConnexion']=$dir.'vues/vueConnexion.php';
