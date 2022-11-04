<?php
if(!isset($guardians)){
    header("location: ".FRONT_ROOT."Home/Home");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardianes</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/guardians-list.css">
</head>
<body>
    <table style="margin-top:150px;">
        <?php
        foreach($guardians as $guardian){
        ?>
            <div class="card">
                <div class="card-header">
                    <h2><?php echo $guardian->getName(); ?></h2>
                </div>
                <div class="card-body">
                    <p><?php echo $guardian->getDescripcion(); ?></p>
                </div>
                <div class="card-footer">
                    <p><?php echo $guardian->getFechaInicio(); ?></p>
                    <p><?php echo $guardian->getFechaFin(); ?></p>
                    <p><?php echo $guardian->getTamanio(); ?></p>
                    <p><?php echo $guardian->getRating(); ?></p>
                </div>
                <a href="<?php echo FRONT_ROOT.'Home/ShowGuardianInfo/'. $guardian->getIdGuardian(). '/' . $fechaInicio . '/' . $fechaFin ?>" class="verMas">
                    +
                </a>
            </div>
        <?php } ?>
    </table>

    <?php require_once(VIEWS_PATH."sidebar.php") ?>
</body>
</html>