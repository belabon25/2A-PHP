<?php
class ControllerUser extends ControllerAbstract
{   
    public function createPage(){
        $todoListModel = new todolistModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        $nbListesTotal = $todoListModel->getNbPublicLists();
        $nbPage = ceil($nbListesTotal/$this->nbListesParPage);
        $page=$this->setPage($nbListesTotal,$this->nbListesParPage);
        $pageAffichage=$page+1;//sert pour l'affichage
        $_SESSION['pageT']=$pageAffichage;
        $res = $todoListModel->getPublicLists($page, $this->nbListesParPage);
        require($GLOBALS["vues"]['vueEnTete']);
        require($GLOBALS["vues"]['vueTaskPublic']);
        require($GLOBALS["vues"]['vueTaskPriveeNonCo']);   
    }

    //Le constructeur regarde quel paramètre est donné pour ensuite choisir quelle page affichée
    public function __construct(string $action)
    {
        if (empty($action)) {
            switch ($action) {
                case ("connexion"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueConnexion']);
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
                    $this->createPublicPage();
            }
        } else {
            $this->createPublicPage();
        }
    }
}
