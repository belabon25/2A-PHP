<?php
if (isset($_GET["page"])) {
    $numPage=$_GET["page"];
    Validation::    
}
else {
    $page=1;
}

$gatewayTodolist = new gatewayTodolist($dsn, $user, $passwd);