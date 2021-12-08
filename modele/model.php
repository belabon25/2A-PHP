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

    //task
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

    //list
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

    //user
    public function getUser(string $userName, string $passwdHash):user{
        return $this->gtUser->getUser($userName,$passwdHash);
    }
    public function getUserFromid(int $userId):user{
        return $this->gtUser->getUserFromid($userId);
    }
    public function addUser(string $userName, string $passwd):void{
        $this->gtUser->addUser($userName,$passwd);
    }
    public function connection(string $name, string $passwd):bool{
        $user=$this->getUser($name,$passwd);
        if ($user->getId()==-1) {
            return false;
        }
        $_SESSION['id']=$user->getId();
        $_SESSION['role']='connected';
        return true;
    }
    public static function deconnexion():void{
        session_unset();
        session_destroy();
        $_SESSION=array();
    }
}