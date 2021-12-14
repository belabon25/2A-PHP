<?php
class user{
    private $name;
    private $role;
    public function __construct(string $name,string $role)
    {
        $this->role=$role;
        $this->name=$name;
    }

    public function getName():string{
        return $this->name;
    }

    public function getRole():string{
        return $this->role;
    }
}