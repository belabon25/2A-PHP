<?php
abstract class ControllerAbstract
{
    //La page web affichera ce nombre de lignes par pages
    protected $nbListesParPage = 1;

    //Vérifie si la page donnée est valide
    public function setPage(int $nbListes) : int
    {
        if (isset($_GET["page"])) {
            $numPage = $_GET["page"];
            $numPage=Validation::validatePageNb($numPage, $nbListes, $this->nbListesParPage);
        } else {
            $numPage = 1;
        }
        return $numPage-1;
    }

    //Fonction appelée pour créer la page
    abstract public function createPage();
   

    //Teste, valide et ajoute une liste
    public function validateAndAddList()
    {
       if (isset($_POST["fname"]) && isset($_POST["fvisibility"])) {
            $i=1;
            $tabTask=array();
            $name=$_POST["fname"];
            $visibility=$_POST["fvisibility"]=="public"?1:0;
            while(isset($_POST["ft".$i]) and !empty($_POST["ft".$i])){
                $tabTask[]=$_POST[("ft".$i)];
                $i+=1;
            }
            Validation::validateFormNewList($name,$tabTask);
            $todoListModel=new todolistModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            $todoListModel->addList($name,$visibility,$tabTask);
        }
    }

    //Teste, valide une connexion
    public function validateConnexion()
    {
        if(isset($_POST["fname"]) && isset($_POST["fpasswd"])){
            $name=$_POST["fname"];
            $passwd=$_POST["fpasswd"];
            Validation::validateUser($name,$passwd);
            $userModel=new userModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);

        }
    }

    //Met à jour le booléen isDone d'une tache
    public function updateTache()
    {
        if(isset($_POST["idTache"])){
            $idTache=$_POST["idTache"];
            $tModel=new taskModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            $tModel->updateDone($idTache,$_POST[$idTache]=='0'?boolval(0):boolval(1));
        }
    }
}
