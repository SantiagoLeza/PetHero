<?php

if(!isset($guardian)){
    header("location: ".FRONT_ROOT."Home/Home");
}

if($fechaInicio == ''){
    $fechaInicio = date("Y-m-d");
}

if($fechaFin == ''){
    $fechaFin = date("Y-m-d");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $guardian->getName(). ' '. $guardian->getSurname(); ?></title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>guardian-info.css">
</head>
<body>
    <div class="content">
        <div class="contentHeader">
            <div class="portada">
                
                <p class="headerName"><?php echo $guardian->getName(). ' '. $guardian->getSurname(); ?></p>
            </div>
            <img src="<?php echo IMG_PATH.'DefaultUserImg.png' ?>" alt="UserImage" class="imagenPerfil">
        </div>
        <div class="contentBody">
            <div>
                <p class="title">Información personal</p>
                <div class="info">
                    <p class="infoTitle">Descripcion</p>
                    <p class="infoText"><?php echo $guardian->getDescripcion(); ?></p>
                </div>
                <div class="info">
                    <p class="infoTitle">Dirección</p>
                    <p class="infoText"><?php echo $guardian->getDireccionCuidado(); ?></p>
                </div>
                <div class="info">
                    <p class="infoTitle">Teléfono</p>
                    <p class="infoText"><?php echo $guardian->getTelefono(); ?></p>
                </div>
                <div class="info">
                    <p class="tamanio">Tamaños aceptados</p>
                    <input type="checkbox" disabled <?php if(strstr($guardian->getTamanio(), 'pequenio')){echo 'checked';}?>>Pequeño
                    <input type="checkbox" disabled <?php if(strstr($guardian->getTamanio(), 'mediano')){echo 'checked';}?>>Mediano
                    <input type="checkbox" disabled <?php if(strstr($guardian->getTamanio(), 'grande')){echo 'checked';}?>>Grande
                </div>
                <button id="botonReserva">
                    Reservar
                </button>
            </div>
        </div>
    </div>
    <div id="boxReserva">
        <div>
            <div>
                <label for="fechaInicio">Fecha de llegada</label>
                <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo $fechaInicio ?>">
            </div>
            <div>
                <label for="fechaFin">Fecha de salida</label>
                <input type="date" name="fechaFin" id="fechaFin" value="<?php echo $fechaFin ?>">
            </div>
            <div>
                <select name="mascota" id="mascota">
                    <?php
                    $mascotas = $_SESSION['loggedUser']->getMascotas();
                    foreach($mascotas as $mascota){
                    ?>
                        <option value="<?php echo $mascota->getNombre(); ?>"><?php echo $mascota->getNombre(); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <?php require_once(VIEWS_PATH."sidebar.php") ?>
    <script src="<?php echo JS_PATH.'guardianPage.js' ?>"></script>
</body>
</html>