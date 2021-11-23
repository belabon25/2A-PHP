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
        $gt=new gatewayTask($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        $this->tasks=$gt->getTasks($this->idList);
    }
    public function __toString():string
    {
        
        $s = "<div class=\"container\">
                <div class=\"row\">
                </div>
                <div class=\"col-sm-4\">
                <div class=\"alert alert-primary\">
                <h3>$this->name.</h3>
                <p>$this->isPrivate</p>
                <p>$this->isDone</p>
                <p>$this->idUser</p>";
            foreach($this->tasks as $task)
            {
                $s = $s.$task->__toString();
            }
            $s = $s."</div></div></div>";
        return $s;
    }
}
