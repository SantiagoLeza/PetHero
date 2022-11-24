<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hero</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT.'Home/generarSolicitudCambio' ?>" method="post">
        <label for="mail">Ingrese su correo</label>
        <input type="email" name="mail" id="mail">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>