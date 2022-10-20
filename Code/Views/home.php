<?php

use DAO\GuardianDAO as GuardianDAO;

$guardianDAO = new GuardianDAO();

$guardianes = $guardianDAO->GetAll();

require_once(CONFIG_PATH."CheckLog.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hero</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/home.css">
</head>
<body>
    <div class="content">
        <div class="filtros-container">
            <a>Filtrar por fecha</a>
            <a>Filtrar por estrellas</a>
            <a>Filtrar por precio</a>
            <a>Filtrar por ubicación</a>
        </div>
        <div class='guardians-section'>
            <!-- Esto no va, es para guiar hasta que este bonito -->
            <table border=10>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Tamaño</th>
                        <th>Rating</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            
                    foreach($guardianes as $guardian){
                    ?>
                        <tr>
                            <td style="padding:20px;"><?php echo $guardian->getName(); ?></td>
                            <td style="padding:20px;"><?php echo $guardian->getFechaInicio(); ?></td>
                            <td style="padding:20px;"><?php echo $guardian->getFechaFin(); ?></td>
                            <td style="padding:20px;"><?php echo $guardian->getTamanio(); ?></td>
                            <td style="padding:20px;"><?php echo $guardian->getRating(); ?></td>
                            <td style="padding:20px;"><?php echo $guardian->getDescripcion(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
        </div>
    </div>
    <?php
    require_once(VIEWS_PATH . "sidebar.php");
    ?>
</body>
</html>