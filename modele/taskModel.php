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
}