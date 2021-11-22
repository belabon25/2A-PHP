<?php
$gatewayTask=new gatewayTask($dsn,$user,$passwd);
$res=$gatewayTask->getTask();

foreach($res as $task){
    echo $task->getName()."<br>";
    /*echo $task->getDescription()."<br>";
    echo $task->getDateDeb()."<br>";
    echo $task->getDateFin()."<br>";*/
}

$gwtd = new gatewayTodolist($dsn,$user,$passwd);

$gwtd->getAllPublicLists();