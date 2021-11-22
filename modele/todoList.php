<?php
class todoList{
    private $task;
    private $name;
    private $isPrivate;
    private $isDone;
    private $idUser;
    private $idList;
    public function __construct(int $idList,string $name, bool $isPrivate, bool $isDone, int $idUser){
        $this->idList=$idList;
        $this->name=$name;
        $this->isPrivate=$isPrivate;
        $this->isDone=$isDone;
        $this->idUser=$idUser;
        $gt=new gatewayTask($dsn,$user,$passwd);
        $this->task=$gt->getTask($this->idList);
    }
}
