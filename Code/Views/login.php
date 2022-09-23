<?php

if(isset($_GET['error'])){
    echo "<script>alert('" . $_GET['error'] . "');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <div class="background"></div>
    <div class="inicioSesion">
        <h1>Inicio de sesión</h1>

        <form action="../process/loginCheck.php" method="POST">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
                
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar sesion</button>
                
        </form>

        <a class="registrarse" href="../process/signup.php"><p>Registrarse</p></a>

        <a class="recuperar-contra" href="#">Olvidaste tu contraseña?</a>
    </div>
        
</body>
</html>