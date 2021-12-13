<?php
echo "<div class=\"jumbotron text-center\">
        <div>
            <div class=\"p-3 mb-2 bg-warning text-black\">
            <h2>Listes publiques :</h2>
            </div>";
            echo "<div class=\"container\">
            <div class=\"row\" >";
            foreach ($res as $todo) {
                $couleur = $todo->getIsDone()?"success":"primary";
                echo "<div class=\"col alert alert-$couleur\">";
                echo "<h2>".$todo->getName();
                echo "<form action=\"index.php?action=delListPublic\" method=\"POST\">
                    <input type=\"submit\" value=\"".$todo->getIdList()."\" class=\"btn-check\" id=\"".$todo->getIdList()."\"name=\"idListPublic\">
                    <label class=\"btn btn-outline-danger\" for=\"".$todo->getIdList()."\">Supprimer liste</label>
                    </form>
                    </h2>";
                $taches = $todo->getTasks();
                foreach($taches as $t){
                    echo "<p>".$t->getName();
                    echo "<form action=\"index.php?action=verifTache\" method=\"POST\"><input type=\"hidden\" value=\"$pageAffichage\" name=page>";
                    if($t->getisDone())
                    {
                        echo "<input type=\"submit\" value=\"".$t->getId().";0\" class=\"btn-check\" name=\"idTache\" id=\"".$t->getId()."\" autocomplete=\"off\"><label class=\"btn btn-outline-success\" for=\"".$t->getId()."\">&nbspTache réalisée&nbsp&nbsp";
                    }
                    else
                    {
                        echo "<input type=\"submit\" value=\"".$t->getId().";1\" class=\"btn-check\" name=\"idTache\" id=\"".$t->getId()."\" autocomplete=\"off\"><label class=\"btn btn-outline-primary\" for=\"".$t->getId()."\">&nbspTache à faire&nbsp&nbsp";
                    }
                    echo "</label></form></p>";
                }
                echo "</div>";
            }
            echo "</div></div>
             <div>";
            $pagePrec=$pageAffichage-1;
            $pageSuiv=$pageAffichage+1;
            if ($pageAffichage>1) {
                echo "<a class=\"btn btn-primary\" href=\"index.php?page=$pagePrec\">&lt    </a>
                <a class=\"btn btn-primary\" href=\"index.php?page=1\">1</a>";
            }                    
                    
            echo "<a>    $pageAffichage    </a>";
                    
            if ($pageAffichage<$nbPage) {
                echo "<a class=\"btn btn-primary\" href=\"index.php?page=$nbPage\">$nbPage</a>
                <a class=\"btn btn-primary\" href=\"index.php?page=$pageSuiv\">    &gt</a>";
            }
            echo "</div>
        </div>
    </div>";