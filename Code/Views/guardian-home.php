<?php

require_once(CONFIG_PATH."CheckLog.php");

if(!$this->guardianDAO->isGuardian($guardian->getIdUsuario())){
    header("location: ".FRONT_ROOT."Home/Home");
}

use DAO\AnimalDAO as AnimalDAO;
$animalDAO = new AnimalDAO();
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
    <div class="info">
        <p>
            <?php echo $guardian->getName() .' '. $guardian->getSurname(); ?>
        </p>

        <div class="hr"></div><br>
        
        <label>Disponibilidad</label>
        <form action="<?php echo FRONT_ROOT.'Guardian/ActualizarFechas' ?>" method="post" class="fechas">
            <div>
                <label for="fechaInicio">Fecha de inicio</label>
                <label for="fechaFin">Fecha de fin</label>
            </div>
            <div>
                <input type="date" name="fechaInicio" id="fechaInicio" required
                value="<?php echo $guardian->getFechaInicio(); ?>">
                <input type="date" name="fechaFin" id="fechaFin" required
                value="<?php echo $guardian->getFechaFin(); ?>">
            </div>
            <button type="submit">Aplicar</button>
        </form>
        
        <form action="<?php echo FRONT_ROOT.'Guardian/ActualizarPrecio' ?>" method="post">
            <div>
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" value=<?php echo $guardian->getPrecio(); ?> required>
                <button type="submit">✓</button>
            </div>
        </form>
    </div>

    <a class="bn5" href="<?php echo FRONT_ROOT.'Home/Home' ?>">
    <button class="bn-32 bn32">Volver</button>
    </a>
    
    <div class="Reservas">
        <div>
            <div class="headerReserva" id="headerPendientes">
                <h2>Reservas pendientes de confirmacion</h2>
                <p id="trianPendientes">▲</p>
            </div>
            <div id="contentPendientes">
            <?php
            foreach($reservas as $reserva){
                if($reserva->getEstado() == 'Pendiente'){
                    ?>
                    <hr>
                    <div class="reserva reservaPend">
                        <div>
                            <p>Desde:  <?php echo $reserva->getFechaInicio()?></p>
                            <p>Hasta:  <?php echo $reserva->getFechaFin()?></p>
                            <p>
                                $<?php echo $reserva->getPrecio(); ?>
                            </p>
                            <p>
                                <?php echo $animalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
                            </p>
                        </div>
                        <div class="buttons">
                            <form action="<?php echo FRONT_ROOT.'Guardian/AceptarReserva' ?>" method="post">
                                <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
                                <button type="submit" class="aceptar">✓</button>
                            </form>
                            <form action="<?php echo FRONT_ROOT.'Guardian/RechazarReserva' ?>" method="post">
                                <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
                                <button type="submit" class="cancelar">X</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            </div>
        </div>
        <div>
            <div class="headerReserva" id="headerConfirmadas">
                <h2>Reservas confirmadas</h2>
                <p id="trianConfirmadas">▲</p>
            </div>
            <div id="contentConfirmadas">
            <?php
            foreach($reservas as $reserva){
                if($reserva->getEstado() == 'Aceptado'){
                    ?>
                    <hr>
                    <div class="reserva">
                        <p>
                            <?php echo $reserva->getFechaInicio() . ' | ' . $reserva->getFechaFin(); ?>
                        </p>
                        <p>
                            $<?php echo $reserva->getPrecio(); ?>
                        </p>
                        <p>
                            <?php echo $animalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
                        </p>
                    </div>
                    <?php
                }
            }
            ?>
            </div>
        </div>
        <div>
            <div class="headerReserva" id="headerEnCurso">
                <h2>Reservas en curso</h2>
                <p id="trianEnCurso">▲</p>
            </div>
            <div id="contentEnCurso">
            <?php
            foreach($reservas as $reserva){
                if($reserva->getEstado() == 'En curso'){
                    ?>
                    <hr>
                    <div class="reserva">
                        <div>
                            <p>
                                <?php echo $reserva->getFechaInicio() . ' | ' . $reserva->getFechaFin(); ?>
                            </p>
                            <p>
                                $<?php echo $reserva->getPrecio(); ?>
                            </p>
                            <p>
                                <?php echo $animalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            </div>
        </div>
        <div>
            <div class="headerReserva" id="headerFinalizadas">
                <h2>Reservas finalizadas</h2>
                <p id="trianFinalizadas">▲</p>
            </div>
            <div id="contentFinalizadas">
            <?php
            foreach($reservas as $reserva){
                if($reserva->getEstado() == 'Finalizado'){
                    ?>
                    <div class="reserva">
                        <p>
                            <?php echo $reserva->getFechaInicio() . ' | ' . $reserva->getFechaFin(); ?>
                        </p>
                        <p>
                            $<?php echo $reserva->getPrecio(); ?>
                        </p>
                        <p>
                            <?php echo $animalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
                        </p>
                    </div>
                    <?php
                }
            }
            ?>
            </div>
        </div>
        <div>
            <div class="headerReserva" id="headerCancelados">
                <h2>Reservas canceladas</h2>
                <p id="trianCancelados">▲</p>
            </div>
            <div id="contentCancelados">
            <?php
            foreach($reservas as $reserva){
                if($reserva->getEstado() == 'Cancelado'){
                    ?>
                    <hr>
                    <div class="reserva">
                        <div>
                            <?php echo $reserva->getFechaInicio() . ' | ' . $reserva->getFechaFin(); ?>
                        </div>
                        <div>
                            <p>
                                $<?php echo $reserva->getPrecio(); ?>
                            </p>
                            <p>
                                <?php echo $animalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            </div>
        </div>
    </div>
    <script src="<?php echo JS_PATH.'guardianHome.js' ?>"></script>
    <?php require_once(VIEWS_PATH."sidebar.php"); ?>
</body>
</html>