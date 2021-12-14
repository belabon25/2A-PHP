<?php
class Autoload
{
    private static $_instance = null;
    public static function charger()
    {
        if (null !== self::$_instance) {
            throw new RuntimeException(sprintf('%s is already started', __CLASS__));
        }
        self::$_instance = new self();
        if (!spl_autoload_register(array(self::$_instance, '_autoload'),true)) {
            throw new RuntimeException(sprintf('%s : Could not start the autoload', __CLASS__));
        }
    }

    //Chargement automatique des ressources
    private static function _autoload($class)
    {
        global $dir; // récupère la variable globale
        $filename = $class . '.php';
        $dirs = array('modele/', './', 'config/', 'controleur/','DAL/','DAL/gateway/','vues/'); //Préparation au chargement du programme
        foreach ($dirs as $d) {
            $file = $dir . $d . lcfirst($filename);
            if (file_exists($file)) {
                include $file; //Chargement de tous les fichiers
            }
        }
    }
}
