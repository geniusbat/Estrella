<!DOCTYPE html>
<html>
<head>
    <title>Modificar Empleado</title>
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
        <div id="notif"></div>
        <h2 class='d-flex flex-row texto titulo'>Modificando empleado</h2>
        <form action="updateEmpleados.php" class="texto" method="POST" onSubmit="return checkea()">
            <p>DNI: <?php echo($_REQUEST["dni"]);?></p>
            <input id="dni" class="form-control" type="hidden" name="dni" value="<?php echo($_REQUEST["dni"]);?>" placeholder="dni" required pattern="^([0-9]{8}[A-ZÑa-zñ])"maxlength="9">
            <label for="sueldo">Sueldo:</label>
            <input id="sueldo" type="number" class="form-control" name="sueldo" value="<?php echo($_REQUEST["sueldo"]);?>" placeholder="descripcion" required maxlength="10">
            <p>Horario:</p>
            <input type="radio" id="mañana" name="horario" value="Mañana">
            <label for="mañana">Mañana</label><br>
            <input type="radio" id="tarde" name="horario" value="Tarde">
            <label for="tarde">Tarde</label><br>
            <input type="radio" id="completo" name="horario" value="Completo">
            <label for="completo">Completo</label>
            <label for="dias">Días: (Separados por espacios y/o comas)</label>
            <input id="dias" type="dias" class="form-control" name="dias" value="<?php echo($_REQUEST["dias"]);?>" placeholder="descripcion" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ,]+"maxlength="30">
            <input id="id" type="hidden" name="id" value="<?php echo($_REQUEST["id"]);?>"required>
            <button type="submit" class="btn" id="update" name="action" value="update" style="margin-top: 1%;">Enviar</button>
            <button type="submit" class="btn" name="action" value="delete" style="margin-top: 1%;">Eliminar Empleado</button>
        </form>
        
        <script src="../js/verifyFormEmpleados.js">
        </script>
        <?php
        }
    ?>
</body>
</html>