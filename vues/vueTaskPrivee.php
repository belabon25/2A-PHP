<?php
echo "<div class=\"jumbotron text-center\">
        <div class=\"p-3 mb-2 bg-success text-black\">
            <h2>Listes privées :</h2>
            </div>";
            echo "<div class=\"container\">
            <div class=\"row\">";
            foreach ($resP as $todo) {
                echo "<div class=\"col alert alert-primary\">".$todo."</div>";
            }
            echo "</div></div>
             <div>";
            $pagePrec=$pageAffichageP-1;
            $pageSuiv=$pageAffichageP+1;
            if ($pageAffichageP>1) {
                echo "<a href=\"index.php?page=$pagePrec\">&lt    </a>
                <a href=\"index.php?page=1\">1</a>";
            }                    
                    
            echo "<a>    $pageAffichageP    </a>";
                    
            if ($pageAffichageP<$nbPageP) {
                echo "<a href=\"index.php?page=$nbPageP\">$nbPageP</a>
                <a href=\"index.php?page=$pageSuiv\">    &gt</a>";
            }
            echo "</div>
        </div>
    </div>";