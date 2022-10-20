<?php

require_once(CONFIG_PATH."CheckLog.php");

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;

$guardianDAO = new GuardianDAO();

if(!$guardianDAO->isGuardian($_SESSION['loggedUser']->getMail())){
    header("location: ".FRONT_ROOT."Home/Home");
}

$guardian = $guardianDAO->GetByMail($_SESSION['loggedUser']->getMail());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardian</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH.'guardian-home.css' ?>">
</head>
<body>
    <p>
        <?php echo $guardian->getName(); ?>
    </p>
    <p>
        <?php echo $guardian->getFechaInicio() . ' | ' . $guardian->getFechaFin(); ?>
    </p>
    
    <form action="<?php echo FRONT_ROOT.'Guardian/ActualizarFechas' ?>" method="post">
        <div>
            <label for="fechaInicio">Fecha de inicio</label>
            <input type="date" name="fechaInicio" id="fechaInicio" required>
        </div>
        <div>
            <label for="fechaFin">Fecha de fin</label>
            <input type="date" name="fechaFin" id="fechaFin" required>
        </div>
        <button type="submit">Actualizar</button>
    </form>
    <a href="<?php echo FRONT_ROOT.'Home/Home' ?>">Volver</a>
    <?php require_once(VIEWS_PATH."sidebar.php"); ?>
</body>
</html>