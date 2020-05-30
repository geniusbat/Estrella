<!DOCTYPE html>
<html>
<head>
    <title>Añadir producto</title>
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
        ?>
        <!--Formulario-->
        <h2 class='d-flex flex-row texto titulo'>Modificando producto</h2>
        <form action="updateProductos.php" class="texto" method="POST">
        <label for="nombre">Nombre:</label>
        <input id="nombre" class="form-control" name="nombre" value="<?php echo($_REQUEST["nombre"]);?>" placeholder="Nombre" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ]+">
        <label for="descripcion">Descripción:</label>
        <input id="descripcion" type="textarea" class="form-control" name="descripcion" value="<?php echo($_REQUEST["descripcion"]);?>" placeholder="descripcion" required pattern="[A-Za-z0-9ÑñÁÉÚÓÍáéúíó ]+">
        <label for="personalizable">Personalizable:</label>
        <input id="personalizable" type="number" class="form-control" value="<?php echo($_REQUEST["personalizable"]);?>" name="personalizable" pattern="(0|1)" required>
        <label for="preciobase">Precio base:</label>
        <input id="preciobase" type="number" class="form-control" value="<?php echo($_REQUEST["preciobase"]);?>" name="preciobase" required>
        <input id="id" type="hidden" name="id" value="<?php echo($_REQUEST["id"]);?>"required>
        <input id="direccion" type="file" name="direccion" class="form-control" value="<?php echo($_REQUEST["direccion"]);?>" required>
        <button type="submit" class="btn" name="action" value="update" style="margin-top: 1%;">Enviar</button>
        <button type="submit" class="btn" name="action" value="delete" style="margin-top: 1%;">Eliminar producto</button>
        </form>
        <?php
        }
    ?>
</body>
</html>