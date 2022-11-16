<?php

if(!isset($Animal)){
    header("location: ".FRONT_ROOT."Home/Home/Error");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/pet-info.css">
</head>
<body>

    <div class="content">
        <img src="<?php echo ANIMAL_IMG_PATH.'ImagenAnimal/'.$this->archivosDAO->getImagenAnimal($Animal->getIdImagenPerfil()); ?>" alt="" class="imagenAnimal">
        <img src="<?php echo ANIMAL_IMG_PATH.'ImagenVacunas/'.$this->archivosDAO->getImagenVacunas($Animal->getIdCartaVacunacion()); ?>" alt="" class="imagenAnimal">
        <?php
        if($this->archivosDAO->getVideoAnimal($Animal->getIdVideo()) != null){
            echo '<video src="'.ANIMAL_IMG_PATH.'VideoAnimal/'.$this->archivosDAO->getVideoAnimal($Animal->getIdVideo()).'" controls class="videoAnimal"></video>';
        }
        echo $this->archivosDAO->getVideoAnimal($Animal->getIdVideo());
        
        echo "<p> Nombre: ".$Animal->getNombre()."</p>";
        echo "<p> Raza: ".$Animal->getRaza()."</p>";
        echo "<p> Sexo: ".$Animal->getSexo()."</p>";
        echo "<p> Observacion: ".$Animal->getObservaciones()."</p>";
        echo "<p> Edad: ".$Animal->getEdad()." años</p>";
        ?>
    </div>

    <?php require_once(VIEWS_PATH."sidebar.php"); ?>
</body>
</html>