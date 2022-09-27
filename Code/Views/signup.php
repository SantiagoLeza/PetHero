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

        <form action="<?php echo FRONT_ROOT . 'User/Signup' ?>" method="POST">

            <label for="mail">Email</label>
            <input type="mail" id="mail" name="mail" required>
                
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            
            <label for="repeatPassword">Repetir Contraseña</label>
            <input type="password" id="repeatPassword" name="repeatPassword" required>
            
            <label for="name">Nombre y apellido</label>
            <input type="name" id="name" name="name" required>
            
            <label for="phoneNumber">Numero de telefono</label>
            <input type="number" id="phoneNumber" name="phoneNumber" required>
            
            <label for="birthDate">Fecha de nacimiento</label>
            <input type="date" id="birthDate" name="birthDate" required>
            
            <label for="adress">Domicilio</label>
            <input type="text" id="adress" name="adress" required>

            <button type="submit">Enviar</button>
        </form>
    </div>
        
</body>
</html>