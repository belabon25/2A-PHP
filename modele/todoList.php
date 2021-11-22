<?php
class todoList{
    private $tasks;
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
        $this->tasks=$gt->getTasks($this->idList);
    }
    public function __toString():string
    {

        $s = $this->name."<br>".$this->isPrivate."<br>".$this->isDone."<br>".$this->idUser."<br>";
        foreach($this->tasks as $task)
        {
            $s = $s.$task->__toString();
        }
        return $s;
    }
}
