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

if(isset($message)){
    echo "<script type='text/javascript'>alert('$message');</script>";
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
            <div class='guardian-info'>
                <p class="title">Información personal</p>
                <div class="info">
                    <p class="infoText"><?php echo $guardian->getDireccionCuidado(); ?></p>
                    <p class="infoText"><?php echo $guardian->getTelefono(); ?></p>
                    <p class="infoText"><?php echo $guardian->getDescripcion(); ?></p>
                </div>
                <div class="info">
                    <p>Tamaños aceptados</p>
                    <div class="tamanios">
                        <div>
                            <input type="checkbox" disabled <?php if(strstr($guardian->getTamanio(), 'pequenio')){echo 'checked';}?>>Pequeño
                        </div>
                        <div>
                            <input type="checkbox" disabled <?php if(strstr($guardian->getTamanio(), 'mediano')){echo 'checked';}?>>Mediano
                        </div>
                        <div>
                            <input type="checkbox" disabled <?php if(strstr($guardian->getTamanio(), 'grande')){echo 'checked';}?>>Grande
                        </div>
                    </div>
                </div>
                <?php
                if($guardian->getIdUsuario() != $_SESSION['loggedUser']->getIdUsuario()){ ?>
                    <button id="botonReserva" class='bn53'>Reservar</button>
                <?php }
                else{
                    echo '<button id="botonReserva" class="hide"></button>';
                } ?>
            </div>
        </div>
    </div>
    <div id="boxReserva">
        <form action="<?php echo FRONT_ROOT.'User/Reservar' ?>" method="post">
            <button id="closeButtonReserva">
                X
            </button>
            <div>
                <label for="fechaInicio">Fecha de llegada</label>
                <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo $fechaInicio ?>">
            </div>
            <div>
                <label for="fechaFin">Fecha de salida</label>
                <input type="date" name="fechaFin" id="fechaFin" value="<?php echo $fechaFin ?>">
            </div>
            <div>
                <select name="idAnimal" id="mascota">
                    <?php
                    $mascotas = $_SESSION['loggedUser']->getMascotas();
                    foreach($mascotas as $mascota){
                    ?>
                        <option value="<?php echo $mascota->getIdAnimales(); ?>"
                            <?php
                            if(!strstr($guardian->getTamanio(), $mascota->getTamanio())){echo 'disabled';}
                            ?>>
                            <?php echo $mascota->getNombre(); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <input type="hidden" name="idGuardian" value="<?php echo $guardian->getIdGuardian() ?>">
            <input type="hidden" name="precio" value="<?php echo $guardian->getPrecio() ?>">
            <button type="submit">Reservar</button>
        </form>
    </div>

    <?php require_once(VIEWS_PATH."sidebar.php") ?>
    <script src="<?php echo JS_PATH.'guardianPage.js' ?>"></script>
</body>
</html>