<?php
if(!isset($reservas)){
    $reservas = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>reservas.css">
</head>
<body>
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
                                <?php echo $this->AnimalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
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
                            <?php echo $this->AnimalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
                        </p>
                        <div class="pago"><?php 
                            if($reserva->getPago() == 0){
                            ?>
                            <p>No pagado</p>
                            <form action="<?php echo FRONT_ROOT.'User/ShowPagar/'; ?>" method="post">
                                <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
                                <input type="submit" value="Pagar">
                            </form>
                            <?php } else{
                                echo 'Pagado';
                            }
                        ?></div>
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
                                <?php echo $this->AnimalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
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
                            <?php echo $this->AnimalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
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
                                <?php echo $this->AnimalDAO->getAnimalById($reserva->getIdAnimal())->getNombre(); ?>
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