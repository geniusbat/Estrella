<!DOCTYPE html>
<html>
<head>
    <title>Verify login</title>
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
        //Aquí deberíamos poblar la base de datos si fuera necesario
        
        echo("Estamos");
        echo($_REQUEST["user"]);
        echo($_REQUEST["pass"]);
        $user = $_REQUEST["user"];
        $pass = $_REQUEST["pass"];
        $a1 = preg_match("/[A-ZÑa-zñ\_\-0-9]*/",$user);
        $a2 = preg_match("/[A-ZÑa-zñ\_\-0-9]*/",$pass);
        if (($user=="user")and($pass=="pass")and($a1)and($a2)) {//Obtener a través de PDO las constraseñas correctas
            session_start();
            $_SESSION["admin"]=1;
            echo($_SESSION["admin"]);
            header("refresh:1; url=../adminPage.php");
        }
        else {
            header("refresh:5; url=../index.html");
        }
    ?>
</body>
</html>