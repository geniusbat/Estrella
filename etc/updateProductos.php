<!DOCTYPE html>
<html>
<head>
    <title>Tabla</title>
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
        if (isAdmin()) {
            $conDB = iniciaConexion();
            if ("update"==$_REQUEST["action"]) {
                $id = $_REQUEST["id"];
                $nombre = $_REQUEST["nombre"];
                $descripcion = $_REQUEST["descripcion"];
                $personalizable = $_REQUEST["personalizable"];
                $direccion=$_REQUEST["direccion"];
                if (($personalizable!=0)&&($personalizable!=1)) {
                    $personalizable=0;
                }
                $preciobase = $_REQUEST["preciobase"];
                $objExists= $conDB->prepare("SELECT COUNT(1) FROM PRODUCTOS WHERE PRODUCTOS.PRODUCTOID=:id");
                $objExists->bindparam(':id',$id);
                $objExists->execute();
                if ($objExists->fetch()[0]>0) {
                    $objPass= $conDB->prepare("UPDATE PRODUCTOS SET NOMBRE=:nombre,DESCRIPCION=:descripcion,PERSONALIZABLE=:personalizable,PRECIOBASE=:preciobase,DIRECCION=:direccion WHERE PRODUCTOID=:id ");
                    $objPass->bindparam(":nombre",$nombre);$objPass->bindparam(":descripcion",$descripcion);
                    $objPass->bindparam(":personalizable",$personalizable);$objPass->bindparam(":preciobase",$preciobase);
                    $objPass->bindparam(":id",$id);$objPass->bindparam(":direccion",$direccion);
                    $objPass->execute();
                    header("refresh:0; url=viewProductos.php"); 
                }
            }
            elseif ("create"==$_REQUEST["action"]) {
                $nombre = $_REQUEST["nombre"];
                $descripcion = $_REQUEST["descripcion"];
                $personalizable = $_REQUEST["personalizable"];
                $direccion=$_REQUEST["direccion"];
                if (($personalizable!=0)&&($personalizable!=1)) {
                    $personalizable=0;
                }
                $preciobase = $_REQUEST["preciobase"];
                $objPass= $conDB->prepare("INSERT INTO PRODUCTOS(PRODUCTOID,NOMBRE,DESCRIPCION,PERSONALIZABLE,PRECIOBASE,VENTAS,DIRECCION) VALUES(secuenciaproductos.nextval,:nombre,:descripcion,:personalizable,:preciobase,0,:direccion)");
                $objPass->bindparam(":nombre",$nombre);$objPass->bindparam(":descripcion",$descripcion);
                $objPass->bindparam(":personalizable",$personalizable);$objPass->bindparam(":preciobase",$preciobase);
                $objPass->bindparam(":direccion",$direccion);
                $objPass->execute();
                header("refresh:0; url=viewProductos.php"); 
            }
            elseif ("delete"==$_REQUEST["action"]) {
                $id = $_REQUEST["id"];
                $objPass= $conDB->prepare("DELETE FROM PRODUCTOS WHERE PRODUCTOS.PRODUCTOID=:id");
                $objPass->bindparam(":id",$id);
                $objPass->execute();
                header("refresh:0; url=viewProductos.php"); 
            }
        }
        cierraConexion($conDB);
    ?>
</body>
</html>