<!DOCTYPE html>
<html>
<head>
    <title>Cesta</title>
    <meta charset="utf-8">
    <meta lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <?php
        //Manage session
        include("AddHtml/nav.html");
        session_start();
        if (!isset($_SESSION["cesta"])) {
            echo ("Cesta vacía");
        }
        else {
            include("AddHtml/cesta.html");
        }
    ?>
</body>
</html>