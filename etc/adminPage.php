<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php
        session_start();
        if (isset($_SESSION["admin"])) {
            if ($_SESSION["admin"]==1){
                include("../AddHtml/navSecondary.html");
                include("../AddHtml/adminPage.html");
            }
            else {
                header("refresh:0; url=../index.html");
            }
        }
        else {
            $_SESSION["admin"]=0;
            header("refresh:0; url=../index.html");
        }
    ?>
</body>
</html>