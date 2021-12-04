<?php
class ControllerConnected extends ControllerAbstract
{
    //Fonction utilisée pour une création de page
    public function createPage()
    {
        $todoListModel = new todolistModel($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        $nbListesTotal = $todoListModel->getNbPublicLists();
        $nbPage = ceil($nbListesTotal/$this->nbListesParPage);
        $page=$this->setPage($nbListesTotal,$this->nbListesParPage);
        $pageAffichage=$page+1;//sert pour l'affichage
        $_SESSION['pageT']=$pageAffichage;
        $res = $todoListModel->getPublicLists($page, $this->nbListesParPage);

        $nbListesTotal = $todoListModel->getNbPrivateLists($_SESSION['id']);
        $nbPageP = ceil($nbListesTotal/$this->nbListesParPage);
        $pageP=$this->setPage($nbListesTotal,$this->nbListesParPage);
        $pageAffichageP=$pageP+1;
        $resP = $todoListModel->getPrivateLists($pageP, $this->nbListesParPage,$_SESSION['id']);
        require($GLOBALS["vues"]['vueEnTete']);
        require($GLOBALS["vues"]['vueTaskPublic']);
        require($GLOBALS["vues"]['vueTaskPrivee']);
    }

    //Le constructeur regarde quel paramètre est donné pour ensuite choisir quelle page affichée
    public function __construct(string $action)
    {
        if (!empty($action)) {
            switch ($action) {
                case ("connexion"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueConnexion']);
                    break;
                case ("deconnexion"):
                    userModel::deconnexion();
                    header("Location: index.php");
                    break;
                case ("connected"):
                    $this->createPage();
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
                    $this->createPage();
            }
        } else {
            $this->createPage();
        }
    }
}
