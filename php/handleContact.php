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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <?php
        $email = $_REQUEST["email"]; 
        $nombre = $_REQUEST["nombre"];
        $a1 = preg_match("/[a-zñ0-9]+@[a-zñ]+.[a-zñ]+/",$email);
        $a2 = preg_match("/[A-ZÁÉÍÓÚñ]*(\s|[a-zñ]+|[áéíóúÁÉÍÚÓ]*|[A-ZÑ])+/",$nombre);
        include("../AddHtml/navSecondary.html");
        $contenido ="";
        $quiereMandar = isset($_REQUEST["mandar"]);
        session_start();
        if (isset($_SESSION["cesta"])and($quiereMandar)) {
            require_once("../gestionBD.php");
            $conDB = iniciaConexion();
            try {
                foreach ($_SESSION["cesta"] as $elemento) {
                    $objPass= $conDB->prepare("SELECT * FROM PRODUCTOS WHERE PRODUCTOS.PRODUCTOID=:id");
                    $objPass->bindparam(':id',$elemento);
                    $objPass->execute();
                    $contenido = $contenido . "1 de " . $objPass->fetch()[1] . ",";
                }
            }
            catch (PDOexception $e) {
                echo "Erro de búsqueda. \n";
                echo $e->GetMessage();
                $a2 = false; //Obligo al sistema a no mandar el mail.
            }
        }
        if ($a1 and $a2 and isset($email) and isset($nombre)) {
            require '../PHPMailer-5.2-stable/PHPMailerAutoload.php';
            $mail = new PHPMailer;          
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'moligus@gmail.com';                 // SMTP username
            $mail->Password = 'pedrito97';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->setFrom("moligus@gmail.com", "Estrella");
            $mail->addAddress("moligus@gmail.com", $nombre);     // Add a recipient
            $mail->addAddress("moligus@gmail.com");               // Name is optional
            $mail->Subject = 'Pedido de: '.$nombre;
            if ($contenido!="") {
                $mail->Body    = 'Pedido de '. $nombre ." ". $email . ".\n Su pedido fue: ". $contenido;
            }
            else {
                $mail->Body    = 'Pedido de '. $nombre ." ". $email . "\n ";
            }
            if(!$mail->send()) {
                echo 'Error al mandar mensaje';
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Mensaje enviado';
            }
            header( "refresh:3; url=../index.html" );
        }
        else {
            echo "<p>Error en el formulario</p>";
            header( "refresh:5; url=../contact.php" );
        }
    ?>
</body>
</html>