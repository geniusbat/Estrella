<!DOCTYPE html>
<html>
<head>
    <title>Añadir Usuario</title>
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
        require_once("../php/isAdmin.php");
        session_start();
        if (isAdmin()) {
        include("../AddHtml/navSecondary.html");
        ?>
        <!--Formulario-->
        <div class="notif"></div>
        <h2 class='d-flex flex-row texto titulo'>Modificando usuario</h2>
        <form action="updateEmpleados.php" class="texto" method="POST" onSubmit="return isOneChecked()">
             <label for="dni">DNI:</label>
            <input id="dni" class="form-control" name="dni" placeholder="dni" required pattern="^([0-9]{8}[A-ZÑa-zñ])">
            <label for="sueldo">Sueldo:</label>
            <input id="sueldo" type="number" class="form-control" name="sueldo" placeholder="Sueldo" required maxlength="10">
            <p>Horario:</p>
            <input type="radio" id="mañana" name="horario" value="Mañana">
            <label for="mañana">Mañana</label><br>
            <input type="radio" id="tarde" name="horario" value="Tarde">
            <label for="tarde">Tarde</label><br>
            <input type="radio" id="completo" name="horario" value="Completo">
            <label for="completo">Completo</label><br>
            <label for="dias">Días: (Separados por espacios y/o comas)</label>
            <input id="dias" type="dias" class="form-control" name="dias" placeholder="Días" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ,]+"maxlength="30">
            <label for="nombre">Nombre y apellidos:</label>
            <input id="nombre" type="textarea" class="form-control" name="nombre" placeholder="Nombre y apellidos" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ,]+"maxlength="25">
            <label for="direccion">Dirección:</label>
            <input id="direccion" type="textarea" class="form-control" name="direccion" placeholder="Dirección" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ,]+"maxlength="25">
            <label for="telefono">Teléfono:</label>
            <input id="telefono" type="textarea" class="form-control" name="telefono" placeholder="Teléfono" required maxlength="11">
            <button type="submit" class="btn" name="action" value="create" style="margin-top: 1%;">Enviar</button>
        </form>
        
        <script>
            function isOneChecked() {
                if (document.getElementsName("action").value==update) {
                var chx = document.getElementsByTagName("input");
                for (var i=0; i<chx.length; i++) {
                    if ((chx[i].type == 'radio') && (chx[i].checked)) {
                    return true;
                    } 
                }
                document.getElementsName("notif").innerHTML="<p>Por favor eliga un horario</p>";
                return false;
                }
                else {
                    return true;
                }
            }
        </script>
        <?php
        }
    ?>
</body>
</html>