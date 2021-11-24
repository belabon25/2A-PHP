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
            <!-- PAS FINI OSKOUR -->
            <form >
                <label for="fname">Username</label>
                <input type="text" id="fname" name="fname"><br>
                <label for="fpasswd">Password</label>
                <input type="text" id="fpasswd" name="fpasswd"><br>
            </form>
            <?php
            $gatewayTodolist = new gatewayTodolist($dsn, $user, $passwd);
            $res = $gatewayTodolist->getPublicLists(0,4);
            echo "<div class=\"container\">
            <div class=\"row\">";
            foreach ($res as $todo) {
                echo "<div class=\"col alert alert-primary\">".$todo."</div>";
            }
            echo "</div></div>";
            ?>
        </div>
    </div>
</body>

</html>