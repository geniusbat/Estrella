<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
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
            include("../AddHtml/navSecondary.html");
            echo "<h2 class='d-flex flex-row texto titulo'>Productos: </h2>";
            $conDB = iniciaConexion();
            $objPass= $conDB->prepare("SELECT * FROM PRODUCTOS");
            $objPass->execute();
            echo("<table class='tablaShow'>");
            echo("<tr> <th>ID</th> <th>Nombre</th> <th>Descripción</th> <th>Personalizable?</th> <th>PrecioBase</th> <th>Ventas</th> </tr>");
            foreach($objPass as $fila) {
                echo "<tr>";
                echo '<form action="productoModify.php" class="texto" method="POST">';
                echo "<td>",$fila[0],"</td>" ;
                echo "<td>",$fila[1],"</td>" ;
                echo "<td>",$fila[2],"</td>" ;
                echo "<td>",$fila[3],"</td>" ;
                echo "<td>",$fila[4],"</td>" ;
                echo "<td>",$fila[5],"</td>" ;
                echo '<input id="id" name="id" type="hidden" value=',$fila[0],'>';
                echo '<input id="nombre" name="nombre" type="hidden" value=',$fila[1],'>';
                echo '<input id="descripcion" name="descripcion" type="hidden" value=',$fila[2],'>';
                echo '<input id="personalizable" name="personalizable" type="hidden" value=',$fila[3],'>';
                echo '<input id="preciobase" name="preciobase" type="hidden" value=',$fila[4],'>';
                echo '<input id="direccion" name="direccion" type="hidden" value=',$fila[6],'>';
                echo '<td> <button type="submit">Editar</button></td>' ;
                echo "</form></tr>";
            }
            echo("</table>");
            cierraConexion($conDB);
        }
    ?>
     <a href="productoAdd.php"><button class="tablaShow">Crear producto</button></a><br>
     <a href="adminPage.php"><button class="tablaShow">Volver</button></a>
</body>
</html>