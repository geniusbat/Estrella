<!DOCTYPE html>
<html>
<head>
    <title>Usuarios y personas</title>
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
            include("../AddHtml/navSecondary.html");
            echo "<h2 class='d-flex flex-row texto titulo'>Usuarios: </h2>";
            $conDB = iniciaConexion();
            $objPass= $conDB->prepare("SELECT * FROM PERSONAS WHERE PERSONAS.DNI IN (SELECT DNI FROM USUARIOS)");
            $objPass->execute();
            echo("<table class='tablaShow'>");
            echo("<tr> <th>DNI</th> <th>Nombre</th> <th>Dirección</th> <th>Teléfono</th></tr>");
            foreach($objPass as $fila) {
                echo "<tr>";
                echo '<form action="usuarioModify.php" class="texto" method="POST">';
                echo "<td>",$fila[0],"</td>" ;
                echo "<td>",$fila[1],"</td>" ;
                echo "<td>",$fila[2],"</td>" ;
                echo "<td>",$fila[3],"</td>" ;
                echo '<input id="telefono" name="telefono" type="hidden" value=',$fila[3],'>';
                echo '<input id="dni" name="dni" type="hidden" value=',$fila[0],'>';
                echo '<input id="nombre" name="nombre" type="hidden" value=',$fila[1],'>';
                echo '<input id="direccion" name="direccion" type="hidden" value=',$fila[2],'>';
                echo '<td> <button type="submit">Editar</button></td>' ;
                echo "</form></tr>";
            }
            echo("</table>");
            echo '<a href="usuarioAdd.php"><button class="tablaShow">Crear usuario</button></a><br>';
            //Empleados
            echo "<h2 class='d-flex flex-row texto titulo'>Empleados: </h2>";
            $objPass= $conDB->prepare("SELECT * FROM PERSONAS WHERE PERSONAS.DNI NOT IN (SELECT DNI FROM USUARIOS)");
            $objPass->execute();
            echo("<table class='tablaShow'>");
            echo("<tr> <th>DNI</th> <th>Nombre</th> <th>Dirección</th> <th>Teléfono</th></tr>");
            foreach($objPass as $fila) {
                echo "<tr>";
                echo "<td>",$fila[0],"</td>" ;
                echo "<td>",$fila[1],"</td>" ;
                echo "<td>",$fila[2],"</td>" ;
                echo "<td>",$fila[3],"</td>" ;
                echo "</tr>";
            }
            echo("</table>");
            cierraConexion($conDB);
        }
    ?>
    <a href="adminPage.php"><button class="tablaShow">Volver</button></a>
</body>
</html>