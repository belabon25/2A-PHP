<?php
class ControllerConnected
{
    //Le constructeur regarde quel paramètre est donné pour ensuite choisir quelle page afficher
    public function __construct(string $action)
    {
        if (!empty($action)) {
            switch ($action) {
                case ("deconnexion"):
                    ModelConnected::deconnexion();
                    header("Location: index.php");
                    break;
                default:
                    require $vues['error'];
            }
        } else {
            require $vues['error'];
        }
    }
}
