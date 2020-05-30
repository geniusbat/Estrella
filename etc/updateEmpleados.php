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
                $id = $_REQUEST["id"];
                $dni = $_REQUEST["dni"];
                $sueldo = $_REQUEST["sueldo"];
                $dias = $_REQUEST["dias"];
                $horario=$_REQUEST["horario"];
                $objExists= $conDB->prepare("SELECT COUNT(1) FROM EMPLEADOS WHERE EMPLEADOS.EMPLEADOID=:id");
                $objExists->bindparam(':id',$id);
                $objExists->execute();
                if ($objExists->fetch()[0]>0) {
                    $objPass= $conDB->prepare("UPDATE EMPLEADOS SET DNI=:dni,SUELDO=:sueldo,HORARIO=:horario,DIAS=:dias WHERE EMPLEADOID=:id ");
                    $objPass->bindparam(":DNI",$dni);$objPass->bindparam(":SUELDO",$sueldo);
                    $objPass->bindparam(":HORARIO",$horario);$objPass->bindparam(":DIAS",$dias);
                    $objPass->bindparam(":id",$id);
                    $objPass->execute();
                    header("refresh:0; url=viewEmpleados.php"); 
                }
            }
            elseif ("create"==$_REQUEST["action"]) {
                $dni = $_REQUEST["dni"];
                $sueldo = $_REQUEST["sueldo"];
                $dias = $_REQUEST["dias"];
                $horario=$_REQUEST["horario"];
                $nombre=$_REQUEST["nombre"];
                $direccion=$_REQUEST["direccion"];
                $telefono=$_REQUEST["telefono"];

                $objPass= $conDB->prepare("INSERT INTO PERSONAS(DNI,NOMBRE,DIRECCION,TELEFONO) VALUES(:dni,:nombre,:direccion,:telefono)");
                $objPass->bindparam(":dni",$dni);$objPass->bindparam(":nombre",$nombre);
                $objPass->bindparam(":telefono",$telefono);$objPass->bindparam(":direccion",$direccion);
                $objPass->execute();
                $objPass= $conDB->prepare("INSERT INTO EMPLEADOS(EMPLEADOID,DNI,SUELDO,DIAS,HORARIO) VALUES(secuenciaEmpleados.nextval,:dni,:sueldo,:dias,:horario)");
                $objPass->bindparam(":dni",$dni);$objPass->bindparam(":sueldo",$sueldo);
                $objPass->bindparam(":dias",$dias);$objPass->bindparam(":horario",$horario);
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