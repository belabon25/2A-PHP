<?php
class Task{
    private $nom;
    public function __construct(string $nom)
    {
        $this->nom=$nom;
    }
    public function getName():?string{
        return $this->nom;
    }
}