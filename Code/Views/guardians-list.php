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
    <table>
        <?php
        foreach($guardians as $guardian){
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
    </table>

    <?php require_once(VIEWS_PATH."sidebar.php") ?>
</body>
</html>