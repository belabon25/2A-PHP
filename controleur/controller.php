<?php
class Controller
{
    private $nbListesParPage = 4;
    public function setPage(int $nbListes) : int
    {
        if (isset($_GET["page"])) {
            $numPage = $_GET["page"];
            Validation::validatePageNb($numPage, $nbListes, $this->nbListesParPage);
        } else {
            $numPage = 1;
        }
        return $numPage-1;
    }

    private function createPage(int &$nbPage) : array
    {
        $gatewayTodolist = new gatewayTodolist($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]); // A CHANGER PAR MODELE
        $nbListesTotal = $gatewayTodolist->getNbPublicLists();
        $nbPage = ceil($nbListesTotal/$this->nbListesParPage);
        $res = $gatewayTodolist->getPublicLists($this->setPage($nbListesTotal,$this->nbListesParPage), $this->nbListesParPage);
        return $res;
    }

    public function createPublicPage()
    {
        $nbPage = 1;
        $res = $this->createPage($nbPage);
        require($GLOBALS["vues"]['vueTaskPublic']);
    }

    public function createPrivatePage()
    {
        $nbPage = 1;
        $this->createPage($nbPage);
        $gatewayTodolist = new gatewayTodolist($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]); // A CHANGER PAR MODELE
        $nbListesTotal = $gatewayTodolist->getNbPrivateLists(1); //TODO : ajouter la gestion des utilisateurs
        $nbPage = ceil($nbListesTotal/$this->nbListesParPage);
        $res = $gatewayTodolist->getPrivateLists(1,$this->setPage($nbListesTotal,$this->nbListesParPage), $this->nbListesParPage);
        require($vues['vueTaskPrivee']);
    }

    public function __construct()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case (NULL):
                    $this->createPublicPage();
                    break;
                case ("connexion"):
                    require($vues['vueConnexion']);
                    break;
                case ("connected"):
                    $gatewayTodolist = new gatewayTodolist($dsn, $user, $passwd); // A CHANGER PAR MODELE
                    $res = $gatewayTodolist->getPublicLists(0, 4);
                    break;
                default:
                    $this->createPublicPage();
            }
        } else {
            $this->createPublicPage();
        }
    }
}
