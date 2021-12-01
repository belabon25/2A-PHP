<?php

class todolistModel{
    private $gtToDoList;
    public function __construct(string $dsn, string $user, string $passwd){
        $this->gtToDoList=new gatewayTodolist($dsn,$user,$passwd);
    }
    public function getPublicLists(int $page,int $nb):array{
        return $this->gtToDoList->getPublicLists($page,$nb);
    }
    public function getPrivateLists(int $page,int $nb, int $userId):array{
        return $this->gtToDoList->getPrivateLists($page,$nb,$userId);
    }
    public function getNbPublicLists():int{
        return $this->gtToDoList->getNbPublicLists();
    }
    public function getNbPrivateLists(int $userId):int{
        return $this->gtToDoList->getNbPrivateLists($userId);
    }
    public function addList(string $name, bool $isPrivate, array $tabTask, int $userId=NULL):void{
        $isPrivate=$userId==NUll?0:$isPrivate;
        $id=$this->gtToDoList->addList($name,$isPrivate,$userId);
        $tm=new taskModel($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        foreach($tabTask as $t){
            $tm->addTask($t,$id);
        }
    }

    public function addTask()
    {
        $this->gtToDoList->addTask();
    }

    public function delTask()
    {
        $this->gtToDoList->delTask();
    }
    
    public function delList()
    {
        $this->gtToDoList->delList();
    }
}