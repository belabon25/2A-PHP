<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="../config/bootstrap-5.1.3-dist/css/bootstrap.min.css">
<meta charset="utf-8">
</head>
<body>
<div class="jumbotron text-center">
        <h1>My First Bootstrap Page</h1>
        <p>Resize this responsive page to see the effect!</p>
    </div>
    <div class="container">
        <div class="row">
 
        </div>
        <div class="col-sm-4">
            <h3>Column 2</h3>
            <p>Lorem ipsum dolor..</p>
        </div>
        <div class="col-sm-4">
            <h3>Column 3</h3>
            <p>Lorem ipsum dolor..</p>
        </div>
    </div>
    </div>
</body>
</html>

<?php
            $gatewayTask = new gatewayTask($dsn, $user, $passwd);
            $res = $gatewayTask->getTask();

            foreach ($res as $task) {
                echo $task->getName() . "<br>";
                /*echo $task->getDescription()."<br>";
    echo $task->getDateDeb()."<br>";
    echo $task->getDateFin()."<br>";*/
            }

            $gwtd = new gatewayTodolist($dsn, $user, $passwd);

            $gwtd->getAllPublicLists(); 
?>