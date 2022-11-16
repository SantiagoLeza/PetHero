<?php

if(isset($reserva))
{
    header(VIEWS_PATH.'Location: Home/Home');
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>pago.css">
</head>
<body>
    <div class="container">
        <h1 style="text-align:center; margin-top:50px;">Pago</h1>
        <form action="<?php echo FRONT_ROOT.'User/PagarReserva' ?>" method="post" class="formulario">
            <input type="hidden" name="idReserva" value="<?php echo $reserva->getIdReserva(); ?>">
            <input type="hidden" name="monto" value="<?php echo $reserva->getPrecio() * $reserva->getDias() * 0.5 ?>">

            <Label>Numero de tarjeta</Label>
            <input type="text" name="numeroTarjeta" id="numeroTarjeta" required>
            
            <Label>Fecha de vencimiento</Label>
            <input type="month" name="fechaVencimiento" id="fechaVencimiento" required>

            <Label>Nombre del titular</Label>
            <input type="text" name="nombreTitular" id="nombreTitular" required>

            <Label>CVV</Label>
            <input type="text" name="cvv" id="cvv" required>

            <label>DNI del titular</label>
            <input type="text" id="dniTitular" required>

            <label>
                <?php
                echo '$'.$reserva->getPrecio() * $reserva->getDias() * 0.5;
                ?>
            </label>

            <label>
                <input type="checkbox" required>
                Acepto los terminos y condiciones
            </label>

            <input type="submit" value="Pagar">
        </form>
    </div>
    <?php require_once(VIEWS_PATH.'sidebar.php') ?>
</body>
</html>