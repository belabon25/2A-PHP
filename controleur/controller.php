<?php
class Controller
{
    //La page web affichera ce nombre de lignes par pages
    private $nbListesParPage = 4;

    //Vérifie si la page donnée est valide
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

    //Fonction utilisée pour une création de page d'utilisateur simple ET d'utilisateur connecté
    private function createPage(int &$nbPage) : array
    {
        $gatewayTodolist = new gatewayTodolist($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]); // A CHANGER PAR MODELE
        $nbListesTotal = $gatewayTodolist->getNbPublicLists();
        $nbPage = ceil($nbListesTotal/$this->nbListesParPage);
        $res = $gatewayTodolist->getPublicLists($this->setPage($nbListesTotal,$this->nbListesParPage), $this->nbListesParPage);
        return $res;
    }

    //Fonction appelée pour créer la page d'un utilisateur non connecté
    public function createPublicPage()
    {
        $nbPage = 1;
        $res = $this->createPage($nbPage);
        require($GLOBALS["vues"]['vueTaskPublic']);
    }

    //Fonction appelée pour créer la page d'un utilisateur connecté
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

    //Le constructeur regarde quel paramètre est donné pour ensuite choisir quelle page affichée
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
