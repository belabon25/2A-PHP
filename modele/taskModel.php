<?php

class taskModel{
    private $gtTask;
    public function __construct(string $dsn, string $user, string $passwd)
    {
        $this->gtTask=new gatewayTask($dsn,$user,$passwd);
    }
    public function getTasks(int $listId):array{
        return $this->gtTask->getTasks($listId);
    }
    public function addTask($name, $listId):void{
        $this->gtTask->addTask($name,$listId);
    }
    public function updateDone($id, $value):void{
        $this->gtTask->updateDone($id,$value);
    }
    public function delTask(int $taskId)
    {
        $this->gtTask->delTask($taskId);
    }
}