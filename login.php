<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
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
        //Login admin
        session_start();
        if (!isset($_SESSION["admin"])) {
            include("AddHtml/nav.html");
            include("AddHtml/login.html");
        }
        else {
            if ($_SESSION["admin"]==1) {
                header("refresh:0; url=etc/adminPage.php");
            }
        }
    ?>
</body>
</html>