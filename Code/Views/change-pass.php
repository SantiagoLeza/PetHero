<?php

if(isset($message)){
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/login.css">
    <title>Cambio de contraseña</title>
</head>
<body>
<div class="background"></div>

    <div class="inicioSesion">
        <h1>Restablezca su contraseña</h1>

        <form action="<?php echo FRONT_ROOT . 'User/ChangePass' ?>" method="POST">

            <label>Email</label>
            <input type="mail" value="<?php echo $user->getMail() ?>" required disabled>
            <input type="hidden" name="idUsuario" value="<?php echo $user->getIdUsuario() ?>">
            <input type="hidden" name="idSolicitud" value="<?php echo $idSolicitud ?>">
                
            <h2>Ingrese su nueva contraseña</h2>
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="pass1" required>

            <label for="password2">Repita su nueva contraseña</label>
            <input type="password" id="password2" name="pass2" required>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>