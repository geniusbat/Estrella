<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
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
        <h2 class='d-flex flex-row texto titulo'>Creando usuario</h2>
        <form action="updateUsuarios.php" class="texto" method="POST">
            <p>DNI:</p>
            <input id="dni" class="form-control" type="textarea" name="dni" placeholder="dni" required pattern="^([0-9]{8}[A-ZÑa-zñ])"maxlength="9">
            <label for="telefono">Teléfono:</label>
            <input id="telefono" type="textarea" class="form-control" name="telefono" placeholder="telefono" required maxlength="12">
            <label for="nombre">Nombre y apellidos:</label>
            <input id="nombre" type="textarea" class="form-control" name="nombre" placeholder="nombre y apellidos" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ,]+"maxlength="25">
            <label for="direccion">Dirección:</label>
            <input id="direccion" type="textarea" class="form-control" name="direccion" placeholder="direccion" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ,]+"maxlength="25">
            <button type="submit" class="btn" name="action" value="create" style="margin-top: 1%;">Enviar</button>
        </form>
        <?php
        }
    ?>
    <script src="../js/verifyFormUsuario.js"></script>
</body>
</html>