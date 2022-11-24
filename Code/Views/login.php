<?php

if(!empty($message)){
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/login.css">
</head>
<body>
    <div class="background"></div>
    <div class="inicioSesion">
        <h1>Inicio de sesión</h1>

        <form action="<?php echo FRONT_ROOT . 'User/Login' ?>" method="POST">

            <label for="mail">Email</label>
            <input type="mail" id="mail" name="mail" required>
                
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar sesion</button>
                
        </form>

        <a class="registrarse" href="../User/ShowSignupView"><p>Registrarse</p></a>

        <a class="recuperar-contra" href="<?php echo FRONT_ROOT.'Home/ShowChangePassView' ?>">Olvidaste tu contraseña?</a>
    </div>
        
</body>
</html>