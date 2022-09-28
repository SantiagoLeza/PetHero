<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets</title>
</head>
<body>
    <?php
        $user = $_SESSION["loggedUser"];

        use DAO\PerroDAO as PetDAO;
        use Models\Pet as Pet;

        $petDAO = new PetDAO();
        $pets = $petDAO->getAll();

        foreach($pets as $pet){
            if($pet->getMailDuenio() == $user->getMail()){
                echo "<p>".$pet->getNombre()."</p>";
            }
        }
    ?>
    <form action="<?php echo FRONT_ROOT.'User/AddDog' ?>" method="post">

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
        <div>
            <label >Tamaño</label>
            <input type="radio" name="tamanio" id="pequenio" value="pequenio" required>
            <label for="pequenio">Pequeño</label>

            <input type="radio" name="tamanio" id="mediano" value="mediano" required>
            <label for="mediano">Mediano</label>
            
            <input type="radio" name="tamanio" id="grande" value="grande" required>
            <label for="grande">Grande</label>
        </div>
        <div>
            <label for="sexo">Sexo</label>

            <input type="radio" name="sexo" id="macho" value="macho" required>
            <label for="macho">Macho</label>
            <input type="radio" name="sexo" id="hembra" value="hembra" required>
            <label for="hembra">Hembra</label>
            <input type="radio" name="sexo" id="otro" value="otro" required>
            <label for="otro">Otro</label>
        </div>

        <button type="submit">Agregar</button>
    </form>
    <a href="<?php echo FRONT_ROOT.'Home/Home' ?>">Volver a inicio</a>
</body>
</html>