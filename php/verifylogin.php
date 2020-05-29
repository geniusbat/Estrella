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
        //Set up connection
        $conDB = iniciaConexion();
        //Continue
        $usuario = $_REQUEST["user"];
        $pass = $_REQUEST["pass"];
        $a1 = preg_match("/^([0-9]{8}[A-ZÑa-zñ])/",$usuario);
        $a2 = preg_match("/^[A-ZÑa-zñ\_\-0-9]*/",$pass);
        $objPass= $conDB->prepare("SELECT PASS FROM LOGIN WHERE LOGIN.DNI=:usuario");
        try {
            $objPass->bindparam(':usuario',$usuario);
            $objPass->execute();
            $expectedPass= $objPass->fetch()[0]; //De repente esto no funciona
        }
        catch (PDOException $e) {
            $f = fopen("/etc/errors.txt","w");
            fwrite($f,$e->getMessage());
            fclose($f);
        }
        if (($pass==$expectedPass)and($a1)and($a2)) {
            session_start();
            $_SESSION["admin"]=1;
            header("refresh:0; url=../etc/adminPage.php");
        }
        else {
            include("../AddHtml/navSecondary.html");
            echo("<p>Información mal escrita, por favor vuelva a intentarlo</p>");
            header("refresh:6; url=../login.php");
        }

    ?>
</body>
</html>