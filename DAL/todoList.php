<?php
class todoList{
    private $tasks;
    private $name;
    private $isPrivate;
    private $isDone;
    private $idUser;
    private $idList;
    public function __construct(int $idList,string $name, bool $isPrivate, bool $isDone, ?int $idUser){
        $this->idList=$idList;
        $this->name=$name;
        $this->isPrivate=$isPrivate;
        $this->isDone=$this->setIsDone();
        $this->idUser=$idUser;
        $tm=new taskModel($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
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
        $tdm = new todolistModel($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        return $tdm->allTaskDone($this->idList);
    }    
    public function getIsDone():bool{
        return $this->isDone;
    }
    public function getIdUser():int{
        return $this->idUser;
    }
    public function getIdList():int{
        return $this->idList;
    }
    public function __toString():string
    {
        $s = $this->name." ".$this->isPrivate." " .$this->isDone." ".$this->idUser." ";
            foreach($this->tasks as $task)
            {
                $s = $s.$task;
            }
        return $s;
    }
}
