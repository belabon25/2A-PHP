<?php
class ControllerAbstract
{
    //La page web affichera ce nombre de lignes par pages
    private $nbListesParPage = 1;

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

    //Fonction utilisée pour une création de page d'utilisateur simple ET d'utilisateur connecté
    private function createPage(int &$pageAffichage, int &$nbPage) : array
    {
        $todoListModel = new todolistModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        $nbListesTotal = $todoListModel->getNbPublicLists();
        $nbPage = ceil($nbListesTotal/$this->nbListesParPage);
        $page=$this->setPage($nbListesTotal,$this->nbListesParPage);
        $pageAffichage=$page+1;//sert pour l'affichage
        $_SESSION['pageT']=$pageAffichage;
        $res = $todoListModel->getPublicLists($page, $this->nbListesParPage);
        return $res;
    }

    //Fonction appelée pour créer la page d'un utilisateur non connecté
    public function createPublicPage()
    {
        $pageAffichage=0;
        $nbPage = 1;
        $res = $this->createPage($pageAffichage, $nbPage);
        require($GLOBALS["vues"]['vueEnTete']);
        require($GLOBALS["vues"]['vueTaskPublic']);
        require($GLOBALS["vues"]['vueTaskPriveeNonCo']);
    }

    //Fonction appelée pour créer la page d'un utilisateur connecté
    public function createPrivatePage()
    {
        $pageAffichageP=0;
        $nbPageP = 1;
        $res = $this->createPage($pageAffichageP, $nbPageP);
        $todoListModel = new todolistModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        $nbListesTotal = $todoListModel->getNbPrivateLists($_SESSION['id']);
        $nbPageP = ceil($nbListesTotal/$this->nbListesParPage);
        $resP = $todoListModel->getPrivateLists($this->setPage($nbListesTotal,$this->nbListesParPage), $this->nbListesParPage,$_SESSION['id']);
        require($GLOBALS["vues"]['vueEnTete']);
        require($GLOBALS["vues"]['vueTaskPublic']);
        require($GLOBALS["vues"]['vueTaskPrivee']);
    }

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
            $id=$userModel->getUser($name,$passwd);
            if ($id==NULL) {
                return;//vue erreur?
            }
            $_SESSION['id']=$id;
            $_SESSION['role']='connected';
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

    //Le constructeur regarde quel paramètre est donné pour ensuite choisir quelle page affichée
    public function __construct()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case ("connexion"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueConnexion']);
                    break;
                case ("connected"):
                    $this->createPrivatePage();
                    break;
                case ("addList"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueAddList']);
                    break;
                case("verifList"):
                    $this->validateAndAddList();
                    header("Location: index.php");
                    break;
                case("verifConnexion"):
                    $this->validateConnexion();
                    header("Location: index.php");
                    break;
                case("checkTache"):
                    $this->updateTache();
                    $s="Location: index.php?page=".$_GET['page'];
                    header($s);
                    break;
                default:
                    isset($_SESSION['id'])?$this->createPrivatePage():$this->createPublicPage();
            }
        } else {
            $this->createPublicPage();
        }
    }
}
