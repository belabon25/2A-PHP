<?php
echo "<div class=\"jumbotron text-center\">
        <div>
            <div class=\"p-3 mb-2 bg-warning text-black\">
            <h2>Listes publiques :</h2>
            </div>";
            echo "<div class=\"container\">
            <div class=\"row\">";
            foreach ($res as $todo) {
                echo $todo;
            }
            echo "</div></div>
             <div>";
            $pagePrec=$pageAffichage-1;
            $pageSuiv=$pageAffichage+1;
            if ($pageAffichage>1) {
                echo "<a href=\"index.php?page=$pagePrec\">&lt    </a>
                <a href=\"index.php?page=1\">1</a>";
            }                    
                    
            echo "<a>    $pageAffichage    </a>";
                    
            if ($pageAffichage<$nbPage) {
                echo "<a href=\"index.php?page=$nbPage\">$nbPage</a>
                <a href=\"index.php?page=$pageSuiv\">    &gt</a>";
            }
            echo "</div>
        </div>
    </div>";