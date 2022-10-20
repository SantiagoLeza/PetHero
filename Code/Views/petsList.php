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

            use DAO\PerroDAO as PetDAO;
            use Models\Pet as Pet;

            $petDAO = new PetDAO();
            $pets = $petDAO->getAll();

            foreach($pets as $pet){
                if($pet->getMailDuenio() == $user->getMail()){
                    echo "<div class='pet-card'>";
                    echo "<img src='".IMG_PATH."/DefaultUserImg.png' alt=''>";
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
        <form action="<?php echo FRONT_ROOT.'User/AddDog' ?>" method="post">
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
                <label >Tamaño</label>
                <div>
                    <input type="radio" name="tamanio" id="pequenio" value="pequenio" required>
                    <label for="pequenio">Pequeño</label>

                    <input type="radio" name="tamanio" id="mediano" value="mediano" required>
                    <label for="mediano">Mediano</label>
                    
                    <input type="radio" name="tamanio" id="grande" value="grande" required>
                    <label for="grande">Grande</label>
                </div>
            </div>
            <div class="radios">
                <label for="sexo">Sexo</label>

                <div>
                    <input type="radio" name="sexo" id="macho" value="macho" required>
                    <label for="macho">Macho</label>
                    <input type="radio" name="sexo" id="hembra" value="hembra" required>
                    <label for="hembra">Hembra</label>
                    <input type="radio" name="sexo" id="otro" value="otro" required>
                    <label for="otro">Otro</label>
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