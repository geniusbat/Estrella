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
                //VALIDA
                if ($sueldo>999999998) {
                    $sueldo = 999999998;
                }
                else {
                    if ($sueldo<1) {
                        $sueldo=1;
                    }
                }
                $a1 = preg_match("/^([0-9]{8}[A-ZÑa-zñ])/",$dni);
                $a2 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$horario)&&(strlen($horario)<20));
                //INICIA (NPDIAS)
                if ($a1&&$a2) {
                    $objExists= $conDB->prepare("SELECT COUNT(1) FROM EMPLEADOS WHERE EMPLEADOS.EMPLEADOID=:id");
                    $objExists->bindparam(':id',$id);
                    $objExists->execute();
                    if ($objExists->fetch()[0]>0) {
                        $objPass= $conDB->prepare("UPDATE EMPLEADOS SET DNI=:dni,SUELDO=:sueldo,HORARIO=:horario,DIAS=:dias WHERE EMPLEADOID=:id ");
                        $objPass->bindparam(":DNI",$dni);$objPass->bindparam(":SUELDO",$sueldo);
                        $objPass->bindparam(":HORARIO",$horario);$objPass->bindparam(":DIAS",$dias);
                        $objPass->bindparam(":id",$id);
                        $objPass->execute();
                    }
                    header("refresh:0; url=viewEmpleados.php"); 
                }else {
                    echo false;
                    header("refresh:100; url=viewEmpleados.php"); 
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
                //VALIDA
                if ($sueldo>999999998) {
                    $sueldo = 999999998;
                }
                else {
                    if ($sueldo<1) {
                        $sueldo=1;
                    }
                }
                $a1 = preg_match("/^([0-9]{8}[A-ZÑa-zñ])/",$dni);
                $a3 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$horario)&&(strlen($horario)<20));
                $a4 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$direccion)&&(strlen($direccion)<25));
                $a5 = (preg_match("/^[A-ZÑa-zñ\, áéíóúÁÉÍÚÓ]/",$nombre)&&(strlen($nombre)<25));
                $a2 = ((preg_match("/^([+]{0,1}[0-9]{0,3}[0-9]{9})/",$telefono)));
                //INICIA
                if ($a1&&$a2&&$a3&&$a4&&$a5) {
                    $objPass= $conDB->prepare("INSERT INTO PERSONAS(DNI,NOMBRE,DIRECCION,TELEFONO) VALUES(:dni,:nombre,:direccion,:telefono)");
                    $objPass->bindparam(":dni",$dni);$objPass->bindparam(":nombre",$nombre);
                    $objPass->bindparam(":telefono",$telefono);$objPass->bindparam(":direccion",$direccion);
                    $objPass->execute();
                    $objPass= $conDB->prepare("INSERT INTO EMPLEADOS(EMPLEADOID,DNI,SUELDO,DIAS,HORARIO) VALUES(secuenciaEmpleados.nextval,:dni,:sueldo,:dias,:horario)");
                    $objPass->bindparam(":dni",$dni);$objPass->bindparam(":sueldo",$sueldo);
                    $objPass->bindparam(":dias",$dias);$objPass->bindparam(":horario",$horario);
                    $objPass->execute();
                    header("refresh:0; url=viewEmpleados.php"); 
                } else {echo $a2;header("refresh:0; url=viewEmpleados.php"); }
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