<?php
class Task{
    private $nom;
    private $isDone;
    private $id;
    public function __construct(string $nom, bool $isDone, int $id)
    {
        $this->nom=$nom;
        $this->isDone=$isDone;
        $this->id = $id;
    }
    public function getName():?string{
        return $this->nom;
    }
    public function getisDone():?string{
        return $this->isDone;
    }
    public function getId():?string{
        return $this->id;
    }

    //Optionnel, jamais appelé
    public function __toString():string
    {
        $s = $this->nom." ".$this->id." ".$this->isDone;
        return $s;
    }
}
