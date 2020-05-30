<!DOCTYPE html>
<html>
<head>
    <title>Cesta</title>
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
        //Manage session
        include("AddHtml/nav.html");
        require_once("gestionBD.php");
        session_start();
        $conDB = iniciaConexion();
        try {
        if (!isset($_SESSION["cesta"])) {
            echo ("Cesta vacía");
        }
        elseif (count($_SESSION["cesta"])>0) {
            //include("AddHtml/cesta.html");
            $contenido = $_SESSION["cesta"];
            $cadena = "SELECT * FROM PRODUCTOS WHERE ";
            for ($i=0; $i<count($contenido);$i++) {
                if ($i==0) {
                    $cadena = $cadena . " PRODUCTOS.PRODUCTOID=". $contenido[$i];
                }
                else {
                    $cadena = $cadena . " OR PRODUCTOS.PRODUCTOID=". $contenido[$i];
                }
            }
            $objPass= $conDB->prepare($cadena);
            $objPass->execute();
            echo("<table class='tablaShow'>");
            echo("<tr> <th></th> <th>Nombre</th> <th>Descripción</th> <th>PrecioBase</th> <th>Personalizable?</th> </tr>");
            foreach($objPass as $fila) {
                echo "<tr>";
                echo '<form action="php/deleteCesta.php" class="texto" method="POST">';
                ?>
                <td><img src="img/<?php echo($fila[6]); ?>" width="auto" height="10%" style="padding=0px;margin=0px;"></td>
                <?php
                echo "<td>",$fila[1],"</td>" ;
                echo "<td>",$fila[3],"</td>" ;
                echo "<td>",$fila[2],"</td>" ;
                echo "<td>",$fila[4],"</td>" ;
                echo '<input id="id" name="id" type="hidden" value=',$fila[0],'>';
                echo '<td> <button type="submit">Eliminar de la cesta</button></td>' ;
            }
            echo("</table>");
        }
        else {
            echo ("Cesta vacía");
        }
        }
        catch (PDOexception $e) {
            header("refresh:4; url=php/emptyCesta.php");
        }

    ?>
</body>
</html>