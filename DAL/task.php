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
    public function __toString():string
    {

        $s = "<input id=\"idTache\" name=\"idTache\" type=\"hidden\" value=\"$this->id\"><form action=\"index.php?action=checkTache&page=".$_SESSION['pageT']."\" method=\"POST\">"."<p>".$this->nom;
        if($this->isDone)
        {
            $s = $s."<input type=\"submit\" value=\"0\" class=\"btn-check\" name=\"$this->id\" id=\"$this->id\" autocomplete=\"off\" checked><label class=\"btn btn-outline-success\" for=\"$this->id\">Tache réalisée</label>";
        }
        else
        {
            $s = $s."<input id=\"idTache\" name=\"idTache\" type=\"hidden\" value=\"$this->id\">
            <input type=\"submit\" value=\"1\" class=\"btn-check\" name=\"$this->id\" id=\"$this->id\" autocomplete=\"off\">
            <label class=\"btn btn-outline-primary\" for=\"$this->id\">&nbspTache à faire&nbsp&nbsp</label>";            
        }
        return $s."</p></form>";
    }
}
