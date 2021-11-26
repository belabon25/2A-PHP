<?php
class Controller
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
        $pageAffichage=0;
        $nbPage = 1;
        $res = $this->createPage($pageAffichage, $nbPage);
        $todoListModel = new todolistModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        $nbListesTotal = $todoListModel->getNbPrivateLists(1); //TODO : ajouter la gestion des utilisateurs
        $nbPage = ceil($nbListesTotal/$this->nbListesParPage);
        $res = $todoListModel->getPrivateLists(1,$this->setPage($nbListesTotal,$this->nbListesParPage), $this->nbListesParPage);
        require($GLOBALS["vues"]['vueEnTete']);
        require($GLOBALS["vues"]['vueTaskPublic']);
        require($GLOBALS["vues"]['vueTaskPrivee']);
    }

    public function validateAndAddList()
    {
       if (isset($_POST["fname"]) && isset($_POST["fvisibility"])) {
            $i=1;
            $tabTask=array();
            $name=$_POST["fname"];
            $visibility=$_POST["fvisibility"]=="public"?1:0;
            while(isset($_POST["ft".$i])){
                $tabTask[]=$_POST[("ft".$i)];
                $i+=1;
            }
            Validation::validateFormNewList($name,$tabTask);
            $todoListModel=new todolistModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            $todoListModel->addList($name,$visibility,$tabTask);
        }
    }

    //Le constructeur regarde quel paramètre est donné pour ensuite choisir quelle page affichée
    public function __construct()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case (NULL):
                    $this->createPublicPage();
                    break;
                case ("connexion"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueConnexion']);
                    break;
                case ("connected"):
                    $todolistModel = new todolistModel($dsn, $user, $passwd); // A CHANGER
                    $res = $todolistModel->getPublicLists(0, 4);
                    break;
                case ("addList"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueAddList']);
                    break;
                case("verifList"):
                    $this->validateAndAddList();
                    header("Location: index.php");
                    break;
                default:
                    $this->createPublicPage();
            }
        } else {
            $this->createPublicPage();
        }
    }
}
