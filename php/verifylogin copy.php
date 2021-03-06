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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php
        //Aquí deberíamos poblar la base de datos si fuera necesario
        require_once("../gestionBD.php");
        try {
            //Set up connection
            $conDB = new PDO("oci:dbname=localhost/XE","GUSMOLAGU","root");
            $conDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //Continue
            $usuario = $_REQUEST["user"];
            $pass = $_REQUEST["pass"];
            $a1 = preg_match("/^([0-9]{8}[A-ZÑa-zñ])/",$usuario);
            $a2 = preg_match("/^[A-ZÑa-zñ\_\-0-9]*/",$pass);
            $objPass= $conDB->prepare("SELECT PASS FROM LOGIN WHERE LOGIN.DNI=:usuario");
            $objPass->bindparam(':usuario',$usuario);
            $objPass->execute();
            $expectedPass= $objPass->fetch()[0];
            if (($pass==$expectedPass)and($a1)and($a2)) {
                session_start();
                $_SESSION["admin"]=1;
                header("refresh:1; url=../etc/adminPage.php");
            }
            else {
                include("../AddHtml/navSecondary.html");
                echo("<p>Información mal escrita, por favor vuelva a intentarlo</p>");
                header("refresh:6; url=../index.html");
            }
        }
        catch (PDOException $e)  {
            //echo ($e->getMessage());
            echo("Fallo en base de datos");
        }
    ?>
</body>
</html>