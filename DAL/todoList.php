<?php
class todoList{
    private $tasks;
    private $name;
    private $isPrivate;
    private $isDone;
    private $userName;
    private $idList;
    public function __construct(int $idList,string $name, bool $isPrivate, bool $isDone, ?string $userName){
        $this->idList=$idList;
        $this->name=$name;
        $this->isPrivate=$isPrivate;
        $this->isDone=$this->setIsDone();
        $this->userName=$userName;
        $tm=new Model($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        $this->tasks=$tm->getTasks($this->idList);
    }
    public function getTasks():array{
        return $this->tasks;
    }
    public function getName():string{
        return $this->name;
    }
    public function isPrivate():bool{
        return $this->isPrivate;
    }
    public function setIsDone():bool{
        $tdm = new Model($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        return $tdm->allTaskDone($this->idList);
    }    
    public function getIsDone():bool{
        return $this->isDone;
    }
    public function getUserName():int{
        return $this->userName;
    }
    public function getIdList():int{
        return $this->idList;
    }
    public function __toString():string
    {
        $s = $this->name." ".$this->isPrivate." " .$this->isDone." ".$this->userName." ";
            foreach($this->tasks as $task)
            {
                $s = $s.$task;
            }
        return $s;
    }
}
