<html>

<head>
    <title>Error</title>
</head>

<body>

    <h1>Error:</h1>
    <?php
        if (isset($dViewError)) {
            foreach ($dViewError as $error) {
                echo $error;
            }
        }
    ?>
</body>

</html>