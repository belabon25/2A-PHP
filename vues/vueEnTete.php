<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../config/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <meta charset="utf-8">
</head>

<body>
    <div class="jumbotron text-center">
        <div class="p-3 mb-2 bg-secondary text-white">
            <div>
                <h1>To do list !</h1>
                <p>Projet PHP de GOURVES Yoann et LABONNE Benjamin</p>
            </div>
            <div class="align-left">
                <table align="center">
                    <tr><td>
                <a href="index.php?action=addList">
                    <button>
                        Ajouter une liste
                    </button>
                </a>
                </td><td>
                <a href="index.php">
                    <button>
                        Acceuil
                    </button>
                </a>
                </td></tr>
                </table>
                <?php
                if (ModelConnected::isConnected()!=null) {
                    echo "<a href=\"index.php?action=deconnexion\">
                    <button>
                        Deconnexion
                    </button>
                    </a>";
                }
                ?>
            </div>
        </div>
    </div>