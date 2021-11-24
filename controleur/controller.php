<?php
class Controller
{
    private $nbListesparPage = 4;
    public function setPage(int $nbListes) : int
    {
        if (isset($_GET["page"])) {
            $numPage = $_GET["page"];
            Validation::validatePageNb($numPage, $nbListes, $this->nbListesParPage);
        } else {
            $numPage = 1;
        }
        return $numPage;
    }

    private function createPage()
    {
        $gatewayTodolist = new gatewayTodolist($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]); // A CHANGER PAR MODELE
        $nbListesTotal = $gatewayTodolist->getNbPublicLists();
        $nbPage = ceil($nbListesTotal/$this->nbListesparPage);
        $res = $gatewayTodolist->getPublicLists($this->setPage($nbListesTotal,$this->nbListesParPage), $this->nbListesParPage);
    }

    public function createPublicPage()
    {
        $this->createPage();
        require($vues['vueTaskPublic']);
    }

    public function createPrivatePage()
    {
        $this->createPage();
        $gatewayTodolist = new gatewayTodolist($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]); // A CHANGER PAR MODELE
        $nbListesTotal = $gatewayTodolist->getNbPrivateLists(1); //TODO : ajouter la gestion des utilisateurs
        $nbPage = ceil($nbListesTotal/$this->nbListesparPage);
        $res = $gatewayTodolist->getPrivateLists($this->setPage($nbListesTotal,$this->nbListesParPage), $this->nbListesParPage);
        require($vues['vueTaskPrivee']);
    }

    public function __construct()
    {
        switch ($_GET("action")) {
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
        }
    }
}
