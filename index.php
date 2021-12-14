<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="config/bootstrap-5.1.3-dist/css/bootstrap.min.css">
<meta charset="utf-8">
</head>
<?php
require('config/utils.php');

//Chargement de toutes les classes
require('config/autoloader.php');
Autoload::charger();

new FrontController();
?>