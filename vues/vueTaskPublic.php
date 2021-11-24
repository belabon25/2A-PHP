<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../config/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <meta charset="utf-8">
</head>

<body>
    <div class="jumbotron text-center">
        <div class="p-3 mb-2 bg-secondary text-white">
            <h1>To do list !</h1>
            <p>Projet PHP de GOURVES Yoann et LABONNE Benjamin</p>
        </div>
    </div>
    <div class="jumbotron text-center">
        <div>
            <div class="p-3 mb-2 bg-warning text-black">
            <h2>Listes publiques :</h2>
            </div>
            <?php
            echo "<div class=\"container\">
            <div class=\"row\">";
            foreach ($res as $todo) {
                echo "<div class=\"col alert alert-primary\">".$todo."</div>";
            }
            echo "</div></div>";
            ?>
        </div>
    </div>
    <div class="jumbotron text-center">
        <div class="p-3 mb-2 bg-success text-black">
            <h2>Listes privées :</h2>
        </div>
        <div>
            <a href="index.php?action=connexion">
                <button>Connexion</button>
            </a>
        </div>
    </div>
</body>

</html>