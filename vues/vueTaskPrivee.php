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
            <div>
                <?php
                    $pagePrec=$page-1;
                    $pageSuiv=$page+1;
                    if ($page==1) {
                        echo "<a href=\"index.php?page=$pagePrec\">&lt</a>";
                    }                    
                    echo "<a href=\"index.php?page=1\">1</a>
                    <a>$page</a>
                    <a href=\"index.php?page=$nbPage\">$nbPage</a>";
                    if ($page==$nbPage) {
                        echo"<a href=\"index.php?page=$pageSuiv\">&gt</a>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="jumbotron text-center">
        <div class="p-3 mb-2 bg-success text-black">
            <h2>Listes privées :</h2>
        </div>
    </div>
</body>

</html>