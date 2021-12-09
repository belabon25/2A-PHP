<?php
class ControllerUser
{
    //La page web affichera ce nombre de lignes par pages
    protected $nbListesParPage = 4;

    //Vérifie si la page donnée est valide
    public function setPage(int $nbListes): int
    {
        if (isset($_GET["page"]) && !empty($_GET["page"])) {
            $numPage = $_GET["page"];
            $numPage = Validation::validatePageNb($numPage, $nbListes, $this->nbListesParPage);
        } else {
            $numPage = 1;
        }
        return $numPage - 1;
    }

    //Teste, valide et ajoute une liste
    public function validateAndAddList()
    {
        if (isset($_POST["fname"]) && isset($_POST["fvisibility"])) {
            $i = 1;
            $tabTask = array();
            $name = $_POST["fname"];
            $visibility = $_POST["fvisibility"] == "public" ? 0 : 1;
            while (isset($_POST["ft" . $i]) and !empty($_POST["ft" . $i])) {
                $tabTask[] = $_POST[("ft" . $i)];
                $i += 1;
            }
            Validation::validateFormNewList($name, $tabTask);
            $todoListModel = new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            $id = NULL;
            if (isset($_SESSION['id'])) {
                $id = Validation::validateInt($_SESSION['id']);
            }
            $todoListModel->addList($name, $visibility, $tabTask, $id);
        }
    }

    //Teste, valide une connexion
    public function validateConnexion():bool
    {
        if (isset($_POST["fname"]) && isset($_POST["fpasswd"])) {
            $name = $_POST["fname"];
            $passwd = $_POST["fpasswd"];
            Validation::validateUser($name, $passwd);
            $userModel = new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            return $userModel->connection($name, $passwd);
        }
        return false;
    }

    //Met à jour le booléen isDone d'une tache
    public function updateTache()
    {
        if (isset($_POST["idTache"])) {
            $requete = explode(";", $_POST["idTache"]);
            $idTache = $requete[0];
            //$idTache = Validation::validateInt((int)($requete[0]));
            $tModel = new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            $tModel->updateDone($idTache, $requete[1] == '0' ? boolval(0) : boolval(1));
        }
    }

    public function addUser():bool
    {
        if (isset($_POST["fname"]) && isset($_POST["fpasswd"])){
            $name = $_POST["fname"];
            $passwd = $_POST["fpasswd"];
            Validation::validateUser($name, $passwd);
            $tUser=new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
            try {
                $tUser->addUser($name,$passwd);
                $this->validateConnexion();
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }

    public function delListPrivee()
    {
        $idList=Validation::validateInt($_POST["idListPrivee"]);
        $this->delList($idList);
    }
    public function delListPublic()
    {
        $idList=Validation::validateInt($_POST["idListPublic"]);
        $this->delList($idList);
    }

    public function delList(int $idList)
    {
        $tTodolist=new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        try {
            $tTodolist->delList($idList);
        } catch (Exception $e) {
            require $GLOBALS["vues"]['error'];
        }
    }


    //Fonction utilisée pour une création de page
    public function createPage()
    {
        $todoListModel = new Model($GLOBALS["dsn"], $GLOBALS["user"], $GLOBALS["passwd"]);
        $nbListesTotal = $todoListModel->getNbPublicLists();
        $nbPage = ceil($nbListesTotal / $this->nbListesParPage);
        $page = $this->setPage($nbListesTotal, $this->nbListesParPage);
        $pageAffichage = $page + 1; //sert pour l'affichage
        $res = $todoListModel->getPublicLists($page, $this->nbListesParPage);
        require($GLOBALS["vues"]['vueEnTete']);
        require($GLOBALS["vues"]['vueTaskPublic']);
        
        if (isset($_SESSION['id'])) {
            $nbListesTotal = $todoListModel->getNbPrivateLists($_SESSION['id']);
            $nbPageP = ceil($nbListesTotal / $this->nbListesParPage);
            $pageP = $this->setPage($nbListesTotal, $this->nbListesParPage);
            $pageAffichageP = $pageP + 1;
            $resP = $todoListModel->getPrivateLists($pageP, $this->nbListesParPage, $_SESSION['id']);
            require($GLOBALS["vues"]['vueTaskPrivee']);
        }
        else {
            require($GLOBALS["vues"]['vueTaskPriveeNonCo']);   
        }
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
                case ("inscription"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueInscription']);
                    break;
                case ("addUser"):
                    if($this->addUser()){
                    header("Location: index.php");
                    }
                    else {
                        require($GLOBALS["vues"]['vueEnTete']);
                        require($GLOBALS["vues"]['vueInscription']);
                        echo "Nom d'utilisateur déjà pris";
                    }
                    break;
                case ("addList"):
                    require($GLOBALS["vues"]['vueEnTete']);
                    require($GLOBALS["vues"]['vueAddList']);
                    break;
                case ("verifList"):
                    $this->validateAndAddList();
                    header("Location: index.php");
                    break;
                case ("delListPublic"):
                    $this->delListPublic();
                    header("Location: index.php");
                    break;
                case ("delListPrivee"):
                    $this->delListPrivee();
                    header("Location: index.php");
                    break;
                case ("verifConnexion"):
                    if($this->validateConnexion()){
                        header("Location: index.php");
                    }
                    else {
                        require($GLOBALS["vues"]['vueEnTete']);
                        require($GLOBALS["vues"]['vueConnexion']);
                        echo "Nom d'utilisateur ou mot de passe invalide";
                    }
                    break;
                case ("verifTache"):
                    $this->updateTache();
                    $s = "Location: index.php?page=".$_POST['page'];
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
