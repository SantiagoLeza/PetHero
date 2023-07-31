<?php
if (!empty($message)) {
    echo "<script type='text/javascript'>alert('$message');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hero</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>changePass.css">
    <style>
        /* Aquí va el contenido del archivo changePass.css */
        /* ... (copia y pega el contenido del archivo changePass.css aquí) ... */
    </style>
</head>
<body>
    <header>
        <h1>Pet Hero</h1>
    </header>

    <div class="container">
        <form action="<?php echo FRONT_ROOT.'Home/generarSolicitudCambio' ?>" method="post" class="form">
            <label for="mail">Ingrese su correo</label>
            <input type="email" name="mail" id="mail" required>

            <input type="submit" value="Enviar">
        </form>
    </div>

    <section class="section">
        <h2>Consejos para el cuidado de tus mascotas</h2>
        <p>¡Asegúrate de mantener a tus mascotas siempre felices y saludables! Aquí hay algunos consejos útiles:</p>
        <ul>
            <li>Lleva a tu mascota al veterinario regularmente.</li>
            <li>Proporciona una dieta balanceada y agua fresca.</li>
            <li>Brinda un espacio limpio y cómodo para descansar.</li>
            <li>Pasea a tu perro diariamente para que haga ejercicio.</li>
            <li>Juega y pasa tiempo de calidad con tu mascota.</li>
        </ul>
        <img src="cute-pet.jpg" alt="Mascotas felices">
    </section>
</body>
</html>
