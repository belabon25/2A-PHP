<?php
class Task{
    private $nom;
    private $dateDeb;
    private $dateFin;
    public function __construct(string $nom,string $dateDeb,string $dateFin)
    {
        $this->nom=$nom;
        $this->$dateDeb=$dateDeb;
        $this->$dateFin=$dateFin;
    }
    public function getName():?string{
        return $this->nom;
    }    
    public function getDescription():?string{
        return $this->description;
    }   
     public function getDateDeb():?string{
        return $this->dateDeb;
    }    
    public function getDateFin():?string{
        return $this->dateFin;
    }
}