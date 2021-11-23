<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../config/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <meta charset="utf-8">
</head>

<body>
    <div class="jumbotron text-center">
        <h1>To do list !</h1>
        <p>Projet PHP de GOURVES Yoann et LABONNE Benjamin</p>
    </div>
</body>

</html>

<?php
$gatewayTodolist = new gatewayTodolist($dsn, $user, $passwd);
$res = $gatewayTodolist->getAllPublicLists();
foreach ($res as $todo) {
    echo $todo->__toString() . "<BR/>";
}

$gwtd = new gatewayTodolist($dsn, $user, $passwd);

$gwtd->getAllPublicLists();
?>