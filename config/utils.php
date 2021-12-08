<?php
$dir=__DIR__.'/../';
$dsn="mysql:host=localhost;dbname=dbyogourves";//$dsn="mysql:host=berlin.iut.local;dbname=dbyogourves";
$user="yogourves";
$passwd="achanger";

//requires
// require($dir.'controleur/connection.php');
// require($dir.'DAL/gateway/gatewayTask.php');
// require($dir.'DAL/gateway/gatewayUser.php');
// require($dir.'DAL/gateway/gatewayTodolist.php');
// require($dir.'modele/taskModel.php');
// require($dir.'modele/userModel.php');
// require($dir.'modele/todolistModel.php');
// require($dir.'DAL/todoList.php');
// require($dir.'DAL/task.php');
// require($dir.'DAL/user.php');
// require($dir.'config/validation.php');
// require($dir.'controleur/controllerUser.php');
// require($dir.'controleur/controllerConnected.php');
// require($dir.'controleur/frontController.php');

require('autoloader.php');

Autoload::charger();

//vues
$vues['error']=$dir.'vues/error.php';
$vues['vueTaskPublic']=$dir.'vues/vueTaskPublic.php';
$vues['vueTaskPrivee']=$dir.'vues/vueTaskPrivee.php';
$vues['vueConnexion']=$dir.'vues/vueConnexion.php';
$vues['vueInscription']=$dir.'vues/vueInscription.php';
$vues['vueEnTete']=$dir.'vues/vueEnTete.php';
$vues['vueTaskPriveeNonCo']=$dir.'vues/vueTaskPriveeNonCo.php';
$vues['vueAddList']=$dir.'vues/vueAddList.php';