<!DOCTYPE html>
<html>
<head>
    <title>Updating</title>
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
        require_once("../gestionBD.php");
        require_once("../php/isAdmin.php");
        session_start();
        try {
        if (isAdmin()) {
            $conDB = iniciaConexion();
            if ("update"==$_REQUEST["action"]) {
                $telefono = $_REQUEST["telefono"];
                $dni = $_REQUEST["dni"];
                $nombre = $_REQUEST["nombre"];
                $direccion = $_REQUEST["direccion"];
                //Valida
                $a1 = preg_match("/^([0-9]{8}[A-ZÑa-zñ])/",$dni);
                $a2 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$direccion)&&(strlen($direccion)<25));
                $a3 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$nombre)&&(strlen($nombre)<25));
                $a4 = ((preg_match("/^([+]{0,1}[0-9]{0,3}[0-9]{9})/",$telefono)));
                //INICIA
                if ($a1&&$a2&&$a3&&$a4) {
                    $objPass= $conDB->prepare("UPDATE PERSONAS SET DNI=:dni,TELEFONO=:telefono,DIRECCION=:direccion WHERE DNI=:dni ");
                    $objPass->bindparam(":dni",$dni);$objPass->bindparam(":nombre",$nombre);
                    $objPass->bindparam(":telefono",$telefono);$objPass->bindparam(":direccion",$direccion);
                    $objPass->bindparam(":id",$id);
                    $objPass->execute();
                    header("refresh:0; url=viewUsuarios.php"); 
                }
                else {header("refresh:0; url=viewUsuarios.php"); }
            }
            elseif ("create"==$_REQUEST["action"]) {
                $dni = $_REQUEST["dni"];
                $nombre=$_REQUEST["nombre"];
                $direccion=$_REQUEST["direccion"];
                $telefono=$_REQUEST["telefono"];
                //Valida
                $a1 = preg_match("/^([0-9]{8}[A-ZÑa-zñ])/",$dni);
                $a2 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$direccion)&&(strlen($direccion)<25));
                $a3 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$nombre)&&(strlen($nombre)<25));
                $a4 = ((preg_match("/^([+]{0,1}[0-9]{0,3}[0-9]{9})/",$telefono)));
                //INICIA
                if ($a1&&$a2&&$a3&&$a4) {
                    $objPass= $conDB->prepare("INSERT INTO PERSONAS(DNI,NOMBRE,DIRECCION,TELEFONO) VALUES(:dni,:nombre,:direccion,:telefono)");
                    $objPass->bindparam(":dni",$dni);$objPass->bindparam(":nombre",$nombre);
                    $objPass->bindparam(":telefono",$telefono);$objPass->bindparam(":direccion",$direccion);
                    $objPass->execute();
                    header("refresh:0; url=viewUsuarios.php"); 
                }else {header("refresh:100; url=viewUsuarios.php"); }
            }
            elseif ("delete"==$_REQUEST["action"]) {
                $dni = $_REQUEST["dni"];
                $objPass= $conDB->prepare("DELETE FROM PERSONAS WHERE PERSONAS.DNI=:dni");
                $objPass->bindparam(":dni",$dni);
                $objPass->execute();
                header("refresh:0; url=viewUsuarios.php"); 
            }
        }
        }
        catch (PDOException $e) {
            echo ($e->getMessage());
            header("refresh:0; url=viewUsuarios.php"); 
        }
        cierraConexion($conDB);
    ?>
</body>
</html>