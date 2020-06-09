<!DOCTYPE html>
<html>
<head>
    <title>Estrella Productos</title>
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
        include("AddHtml/nav.html");
        require_once("gestionBD.php");
        session_start();
        $conDB = iniciaConexion();
        echo "<div id='notif' style='visibility: hidden;'>Producto añadido</div>";
        $objPass= $conDB->prepare("SELECT * FROM PRODUCTOS");
        $objPass->execute();
        echo ('<div class="d-flex flex-row justify-content-around flex-wrap titulo">');
        foreach($objPass as $fila) {
    ?>
        <div class="producto col-sm-3" style="margin: auto;">
            <img src="/Estrella/img/<?php echo($fila[6]); ?>" width="100px" height="100px">
            <h2><?php echo($fila[1]);?></h2>
            <p><?php echo($fila[2]); ?></p>
            <input id="id" type="hidden" name="id" value="<?php echo($fila[0]);?>">
            <button onClick="addToCesta(<?php echo($fila[0]);?>)">Add to cart</button>
        </div>
    <?php
        }
        echo("</div>");
        cierraConexion($conDB);
    ?>
    <script>
        function addToCesta(selfId) {
        $.post("php/addCesta.php",
            {
                "id": selfId
            },
            function() {
                console.log("Mensaje enviado a cesta");
                console.log(selfId);
    
            }
            );
            document.getElementById("notif").style.visibility="visible";
            setTimeout('document.getElementById("notif").style.visibility="hidden";',800);
        }        
    </script>
</body>
</html>