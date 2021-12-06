<?php
class ControllerConnected
{
    //Le constructeur regarde quel paramètre est donné pour ensuite choisir quelle page affichée
    public function __construct(string $action)
    {
        if (!empty($action)) {
            switch ($action) {
                case ("deconnexion"):
                    userModel::deconnexion();
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
