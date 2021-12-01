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
        $this->isDone=$isDone;
        $this->idUser=$idUser;
        $tm=new taskModel($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        $this->tasks=$tm->getTasks($this->idList);
    }
    public function __toString():string
    {
        $tm=new todoListModel($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        $couleur = $tm->allTaskDone($this->idList)?"success":"primary";
        $s = "<div class=\"col alert alert-$couleur\">";
        $s = $s."  <h3>$this->name.</h3>
                <p>$this->isPrivate</p>
                <p>$this->isDone</p>
                <p>$this->idUser</p>";
            foreach($this->tasks as $task)
            {
                $s = $s.$task;
            }
        return $s."</div>";
    }
}
