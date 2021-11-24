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
}