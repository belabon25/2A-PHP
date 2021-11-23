<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../config/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <meta charset="utf-8">
</head>

<body>
    <div class="jumbotron text-center">
        <div class="p-3 mb-2 bg-secondary text-white">
            <h1>To do list !</h1>
            <p>Projet PHP de GOURVES Yoann et LABONNE Benjamin</p>
        </div>
    </div>
    <div class="jumbotron text-center">
        <div>
            <h2>Listes publiques :</h2>
            <?php
            $gatewayTodolist = new gatewayTodolist($dsn, $user, $passwd);
            $res = $gatewayTodolist->getAllPublicLists();
            foreach ($res as $todo) {
                echo $todo->__toString() . "<BR/>";
            }
            $gwtd = new gatewayTodolist($dsn, $user, $passwd);
            $gwtd->getAllPublicLists();
            ?>
        </div>
    </div>
    <div class="jumbotron text-center">
        <div class="p-3 mb-2 bg-success text-white">
            <h2>Listes privées :</h2>
        </div>
    </div>
</body>

</html>