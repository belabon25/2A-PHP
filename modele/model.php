<?php
class Model{
    private $gtTask;
    private $gtToDoList;
    private $gtUser;
    public function __construct(string $dsn, string $user, string $passwd)
    {
        $this->gtToDoList=new gatewayTodolist($dsn,$user,$passwd);
        $this->gtTask=new gatewayTask($dsn,$user,$passwd);
        $this->gtUser=new gatewayUser($dsn,$user,$passwd);
    }

    //Méthodes utilisées pour intéragir avec les Tâches
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

    //Méthodes utilisées pour intéragir avec les todoLists
    public function getPublicLists(int $page,int $nb):array{
        $premiere=$page*$nb;
        return $this->gtToDoList->getPublicLists($premiere,$nb);
    }
    public function getPrivateLists(int $page,int $nb, string $userName):array{
        $premiere=$page*$nb;
        return $this->gtToDoList->getPrivateLists($premiere,$nb,$userName);
    }
    public function getNbPublicLists():int{
        return $this->gtToDoList->getNbPublicLists();
    }
    public function getNbPrivateLists(string $userName):int{
        return $this->gtToDoList->getNbPrivateLists($userName);
    }
    public function addList(string $name, bool $isPrivate, array $tabTask, string $userName=NULL):void{
        $isPrivate=$userName==null?0:$isPrivate;
        $id=$this->gtToDoList->addList($name,$isPrivate,$userName);
        $tm=new Model($GLOBALS["dsn"],$GLOBALS["user"],$GLOBALS["passwd"]);
        foreach($tabTask as $t){
            $tm->addTask($t,$id);
        }
    } 
    public function delList(int $listId)
    {
        $model=new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        $l=$model->getTasks($listId);
        foreach($l as $t) { 
           $model->delTask($t->getId());
        }
        $this->gtToDoList->delList($listId);
    }
    public function allTaskDone($idList):bool
    {
        return $this->gtToDoList->allTaskDone($idList);
    }

    public function getList($idList):todoList{
        return $this->gtToDoList->getList($idList);
    }

    //Méthodes utilisées pour intéragir avec les utilisateurs
    public function getUser(string $userName):user{
        return $this->gtUser->getUser($userName);
    }
    public function getHashedPasswd(string $userName):string{
        return $this->gtUser->getHashedPasswd($userName);
    }
    public function addUser(string $userName, string $passwd):void{
        $passwd=password_hash($passwd,CRYPT_BLOWFISH);
        $this->gtUser->addUser($userName,$passwd);
    }
}