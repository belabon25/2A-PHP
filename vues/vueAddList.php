<div class="jumbotron text-center">
        <div>
            <div class="p-3 mb-2 bg-warning text-black">
                <h2>Connexion</h2>
            </div>
            <div class="w-25 col-md-8 mx-auto">
            <!-- mettre le fichier qui gere ca ici -->
                <form action="index.php?action=verifList" method="POST">
                    <div class="form-row align-items-center">
                        <div class="form-group row-auto">
                            <label for="fname">Nom</label>
                            <input class="form-control" type="text" id="fname" name="fname"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°1</label>
                            <input class="form-control" type="text" id="ft1" name="ft1"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°2</label>
                            <input class="form-control" type="text" id="ft2" name="ft2"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°3</label>
                            <input class="form-control" type="text" id="ft3" name="ft3"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°4</label>
                            <input class="form-control" type="text" id="ft4" name="ft4"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°5</label>
                            <input class="form-control" type="text" id="ft5" name="ft5"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°6</label>
                            <input class="form-control" type="text" id="ft6" name="ft6"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°7</label>
                            <input class="form-control" type="text" id="ft7" name="ft7"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°8</label>
                            <input class="form-control" type="text" id="ft8" name="ft8"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°9</label>
                            <input class="form-control" type="text" id="ft9" name="ft9"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Tache n°10</label>
                            <input class="form-control" type="text" id="ft10" name="ft10"><br>
                        </div>
                        <div class="form-group col-auto">
                            <fieldset>
                                <legend>Visibilité de la liste:</legend>
                                <?php
                                if (ModelConnected::isConnected()!=null) {
                                    echo "<div>
                                    <input type=\"radio\" id=\"fprivate\" name=\"fvisibility\" value=\"private\"  checked>
                                    <label for=\"fprivate\">Privé</label>
                                    </div>";
                                    echo "<div>
                                    <input type=\"radio\" id=\"fpublic\" name=\"fvisibility\" value=\"public\">
                                    <label for=\"fpublic\">Publique</label>
                                    </div>";
                                }
                                else
                                {
                                    echo "<div>
                                    <input type=\"radio\" id=\"fprivate\" name=\"fvisibility\" value=\"private\" disabled>
                                    <label for=\"fprivate\">Privé</label>
                                    </div>";
                                    echo "<div>
                                    <input type=\"radio\" id=\"fpublic\" name=\"fvisibility\" value=\"public\"  checked>
                                    <label for=\"fpublic\">Publique</label>
                                    </div>";                                    
                                }                             
                                ?>
                            </fieldset>
                        </div>
                        <div class="form-group row-auto">
                            <input class="btn btn-primary" type="submit" value="Valider">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>