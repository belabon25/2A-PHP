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
                <h2>Connexion</h2>
            </div>
            <div class="w-25 col-md-8 mx-auto">
            <!-- mettre le fichier qui gere ca ici -->
                <form action="">
                    <div class="form-row align-items-center">
                        <div class="form-group row-auto">
                            <label for="fname">Username</label>
                            <input class="form-control" type="text" id="fname" name="fname"><br>
                        </div>
                        <div class="form-group row-auto">
                            <label for="fpasswd">Password</label>
                            <input class="form-control" type="text" id="fpasswd" name="fpasswd"><br>
                        </div>
                        <div class="form-group row-auto">
                            <input class="btn btn-primary" type="submit" value="connect">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>