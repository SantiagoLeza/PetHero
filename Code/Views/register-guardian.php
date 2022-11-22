<?php
require_once(CONFIG_PATH."CheckLog.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quieres ser guardian?</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH.'register-guardian.css' ?>">
</head>
<body>
    <div class="content">
        <p>Desea ser guardian?</p>
        <p>Es simple. Completa esta informacion</p>
        <form action="<?php echo FRONT_ROOT.'Guardian/Add' ?>" method="post">
            <div>
                <label for="initialDate">Cuando puedes empezar a cuidar?</label>
                <input type="date" name="initialDate" id="initialDate" required>
            </div>

            <div>
                <label for="finalDate">Cuando puedes dejaras de estar disponible?</label>
                <input type="date" name="finalDate" id="finalDate" required>
            </div>

            <div>
                <label for="address">Direccion</label>
                <input type="text" name="address" id="address" required>
            </div>

            <div>
                <label for="">Seleccione tamaños dispuestos a cuidar</label>
                <div>
                    <input type="checkbox" name="tamanio[]" id="pequenio" value="pequenio">
                    <label for="pequenio">Pequeño</label>
                    
                    <input type="checkbox" name="tamanio[]" id="mediano" value="mediano">
                    <label for="mediano">Mediano</label>
                    
                    <input type="checkbox" name="tamanio[]" id="grande" value="grande">
                    <label for="grande">Grande</label>
                    
                </div>
            </div>

            <div>
                <label for="precio">Indique su precio</label>
                <input type="number" name="precio" id="precio" required>
            </div>

            <div>
                <label for="description">Describete</label>
                <br>
                <textarea name="description" id="description" placeholder="Escribe aqui..." required></textarea>
            </div>
            
            <button class="bn3" type="submit"> Ser Heroe </button>
            
        </form>
    </div>
    <?php require_once(VIEWS_PATH."sidebar.php"); ?>
</body>
</html>