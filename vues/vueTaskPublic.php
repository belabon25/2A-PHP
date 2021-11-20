<?php
$gatewayTask=new gatewayTask($dsn,$user,$passwd);
$res=$gatewayTask->getPublicTask();

foreach($res as $task){
    echo $task->getName()."<br>";
    echo $task->getDescription()."<br>";
    echo $task->getDateDeb()."<br>";
    echo $task->getDateFin()."<br>";
}