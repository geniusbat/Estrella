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
                $objPass= $conDB->prepare("UPDATE PERSONAS SET DNI=:dni,TELEFONO=:telefono,DIRECCION=:direccion WHERE DNI=:dni ");
                $objPass->bindparam(":dni",$dni);$objPass->bindparam(":nombre",$nombre);
                $objPass->bindparam(":telefono",$telefono);$objPass->bindparam(":direccion",$direccion);
                $objPass->bindparam(":id",$id);
                $objPass->execute();
                header("refresh:0; url=viewEmpleados.php"); 
            }
            elseif ("create"==$_REQUEST["action"]) {
                $dni = $_REQUEST["dni"];
                $nombre=$_REQUEST["nombre"];
                $direccion=$_REQUEST["direccion"];
                $telefono=$_REQUEST["telefono"];
                $objPass= $conDB->prepare("INSERT INTO PERSONAS(DNI,NOMBRE,DIRECCION,TELEFONO) VALUES(:dni,:nombre,:direccion,:telefono)");
                $objPass->bindparam(":dni",$dni);$objPass->bindparam(":nombre",$nombre);
                $objPass->bindparam(":telefono",$telefono);$objPass->bindparam(":direccion",$direccion);
                $objPass->execute();
                header("refresh:0; url=viewEmpleados.php"); 
            }
            elseif ("delete"==$_REQUEST["action"]) {
                $id = $_REQUEST["id"];
                $objPass= $conDB->prepare("DELETE FROM EMPLEADOS WHERE EMPLEADOS.EMPLEADOID=:id");
                $objPass->bindparam(":id",$id);
                $objPass->execute();
                header("refresh:0; url=viewEmpleados.php"); 
            }
        }
        }
        catch (PDOException $e) {
            echo ($e->getMessage());
            header("refresh:0; url=viewEmpleados.php"); 
        }
        cierraConexion($conDB);
    ?>
</body>
</html>