<?php
require_once(CONFIG_PATH."CheckLog.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/petsList.css">
</head>
<body>
    <div class="pet-cards">
        <?php
            foreach($pets as $pet){
                {
                    echo "<div class='pet-card'>";
                    echo "<div class='pet-image'>";
                    ?>
                    <img src="<?php echo ANIMAL_IMG_PATH.'ImagenAnimal/'.$this->archivosDAO->getImagenAnimal($pet->getIdImagenPerfil()); ?>" alt="" class="imagenAnimal">
                    <?php
                    echo "<img src='".IMG_PATH."/". $pet->getTipo() .".png' alt='' class='icono logo-". $pet->getTipo() ."'>";
                    echo "</div>";
                    echo "<a style='color:black;' href='".FRONT_ROOT.'User/PetInfo/'.$pet->getIdAnimales()."'><p>".$pet->getNombre()."</p></a>";
                    echo "<div><p>".$pet->getRaza()."</p>";
                    echo "<p>".$pet->getEdad()." años</p></div>";
                    echo "</div>";
                }
            }
        ?>
    </div>
    <button class="agregarMascotaBoton" id="agregarMascotaBoton">
        Agregar Mascota
    </button>
    <div class="formMascota" id="formMascota">
        <form  enctype='multipart/form-data' action="<?php echo FRONT_ROOT.'User/AddAnimal' ?>" method="post">
            <button class="closeForm" id="closeForm" type="button">
                X
            </button>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div>
                <label for="edad">Edad</label>
                <input type="number" name="edad" id="edad" min='0' required>
            </div>
            <div class="tipoAnimal">
                <div>
                    <select id="selectTipo">
                        <option value="perro" id="perro">Perro</option>
                        <option value="gato" id="gato">Gato</option>
                    </select>
                </div>
                <div>
                    <label for="raza">Raza</label>
                    <div id="selectContainer">
                        <select name="raza" id="razaPerro" class="selectAnimal">
                            <?php
                                $razas = $this->AnimalDAO->GetRazas();
            
                                foreach($razas as $r){
                                    if($r['tipo'] == "perro"){
                                        echo "<option value='".$r['raza']."'>".$r['raza']."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <select name="raza" id="razaGato" class="selectAnimal">
                            <?php
                                $razas = $this->AnimalDAO->GetRazas();
            
                                foreach($razas as $r){
                                    if($r['tipo'] == "gato"){
                                        echo "<option value='".$r['raza']."'>".$r['raza']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="radios">
                <label for="sexo">Sexo</label>

                <div>
                    <input type="radio" name="sexo" id="macho" value="macho" required>
                    <label for="macho">Macho</label>
                    <input type="radio" name="sexo" id="hembra" value="hembra" required>
                    <label for="hembra">Hembra</label>
                </div>
            </div>
            <div>
                <label>Archivos</label>
                
                <label for="imagenAnimal" class="labelInputFoto">Foto animal</label>
                <input type="file" name="imagenAnimal" id="imagenAnimal" required
                accept=".jpg, .png, .jpeg, image/*" style="visibility:hidden;">

                <label for="imagenCarta" class="labelInputFoto">Carta de vacunacion</label>
                <input type="file" name="imagenCarta" id="imagenCarta"
                accept=".jpg, .png, .jpeg, image/*" style="visibility:hidden;" required>
                
                <label for="video" class="labelInputFoto">Video animal</label>
                <input type="file" name="video"
                accept="video/ *" style="visibility:hidden;" >
            </div>
            <div>
                <label for="observaciones">Observaciones</label>
                <input type="text" name="observaciones" id="observaciones">
            </div>

            <button type="submit" class="addButton">Agregar</button>
        </form>
    </div>
    <a href="<?php echo FRONT_ROOT.'Home/Home' ?>">Volver a inicio</a>
    <?php
    require_once(VIEWS_PATH."sidebar.php");
    ?>
    <script src="<?php echo JS_PATH ?>/agregarMascota.js"></script>
</body>
</html>