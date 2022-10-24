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
            $user = $_SESSION["loggedUser"];

            use DAO\AnimalDAO as PetDAO;
            use Models\Pet as Pet;

            $petDAO = new PetDAO();
            $pets = $petDAO->getAll();

            foreach($pets as $pet){
                if($pet->getMailDuenio() == $user->getMail()){
                    echo "<div class='pet-card'>";
                    echo "<div class='pet-image'>";
                    echo "<img src='".IMG_PATH."/DefaultUserImg.png' alt='' class='foto'>";
                    echo "<img src='".IMG_PATH."/". $pet->getTipo() .".png' alt='' class='icono logo-". $pet->getTipo() ."'>";
                    echo "</div>";
                    echo "<p>".$pet->getNombre()."</p>";
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
        <form action="<?php echo FRONT_ROOT.'User/AddAnimal' ?>" method="post">
            <button class="closeForm" id="closeForm" type="button">
                X
            </button>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div>
                <label for="raza">Raza</label>
                <input type="text" name="raza" id="raza" required>
            </div>
            <div>
                <label for="edad">Edad</label>
                <input type="number" name="edad" id="edad" min='0' required>
            </div>
            <div class="radios">
                <label for="tipo">Tipo</label>

                <div>
                    <input type="radio" name="tipo" id="perro" value="perro" required checked>
                    <label for="perro">Perro</label>
                    <input type="radio" name="tipo" id="gato" value="gato" required>
                    <label for="gato">Gato</label>
                </div>
            </div>
            <div class="select" id="div-tamanio">
                <label >Tamaño</label>
                <select name="tamanio" id="tamanio">
                    <option value="chico" checked>Chico</option>
                    <option value="mediano">Mediano</option>
                    <option value="grande">Grande</option>
                </select>
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