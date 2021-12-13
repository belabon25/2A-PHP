<?php
echo "<div class=\"jumbotron text-center\">
        <div class=\"p-3 mb-2 bg-success text-black\">
            <h2>Listes privées :</h2>
            </div>";
            echo "<div class=\"container\">
            <div class=\"row\">";
            foreach ($resP as $todo) {
                $couleur = $todo->getIsDone()?"success":"primary";
                echo "<div class=\"col alert alert-$couleur\">";
                echo "<h2>".$todo->getName();
                echo "<form action=\"index.php?action=delListPrivee\" method=\"POST\">
                <input type=\"submit\" value=\"".$todo->getIdList()."\" class=\"btn-check\" id=\"".$todo->getIdList()."\"name=\"idListPrivee\">
                <label class=\"btn btn-outline-danger\" for=\"".$todo->getIdList()."\">Supprimer liste</label>
                </form>
                </h2>";
                $taches = $todo->getTasks();
                foreach($taches as $t){
                    echo "<p>".$t->getName();
                    echo "<form action=\"index.php?action=verifTache\" method=\"POST\"><input type=\"hidden\" value=\"$pageAffichageP\" name=page>";
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
            echo "</div>
             <div>";
            $pagePrec=$pageAffichageP-1;
            $pageSuiv=$pageAffichageP+1;
            if ($pageAffichageP>1) {
                echo "<a class=\"btn btn-primary\" href=\"index.php?pageP=$pagePrec\">&lt    </a>
                <a class=\"btn btn-primary\" href=\"index.php?pageP=1\">1</a>";
            }                    
                    
            echo "<a>    $pageAffichageP    </a>";
                    
            if ($pageAffichageP<$nbPageP) {
                echo "<a class=\"btn btn-primary\" href=\"index.php?pageP=$nbPageP\">$nbPageP</a>
                <a class=\"btn btn-primary\" href=\"index.php?pageP=$pageSuiv\">    &gt</a>";
            }
            echo "</div>
        </div>
    </div>";