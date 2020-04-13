<!DOCTYPE html>
<html>
<head>
    <title>Estrella Sent</title>
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
        $email = $_REQUEST["email"]; 
        $nombre = $_REQUEST["nombre"];
        $a1 = preg_match("/[a-zñ0-9]+@[a-zñ]+.[a-zñ]+/",$email);
        $a2 = preg_match("/[A-ZÁÉÍÓÚñ]*(\s|[a-zñ]+|[áéíóúÁÉÍÚÓ]*|[A-ZÑ])+/",$nombre);
        include("AddHtml/nav.html");
        if ($a1 and $a2 and isset($email) and isset($nombre)) {
            foreach ($_REQUEST as $key => $value) {
                echo $key . " ". $value . "<br>";
                }
                header( "refresh:5; url=index.html" );
        }
        else {
            echo "<p>Error en el formulario</p>";
            header( "refresh:5; url=contact.php" );
        }
    ?>
</body>
</html>