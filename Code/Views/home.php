<?php

use DAO\GuardianDAO as GuardianDAO;

$guardianDAO = new GuardianDAO();

$guardianes = $guardianDAO->GetAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hero</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>/home.css">
</head>
<body>
    <div class="content">
        <div class="filtros-container">
            <a>Filtrar por fecha</a>
            <a>Filtrar por estrellas</a>
            <a>Filtrar por precio</a>
            <a>Filtrar por ubicación</a>
        </div>
        <div class='guardians-section'>
            <!-- Esto no va, es para guiar hasta que este bonito -->
            <div class='guardian-card'>
                <p>Nombre</p>
                <p>Fecha de inicio</p>
                <p>Fecha de fin</p>
                <p>Tamaño</p>
                <p>Rating</p>
                <p>Descripcion</p>
            </div>
            <?php
        
            foreach($guardianes as $guardian){
            ?>
                <div class='guardian-card'>
                    <p>
                        <?php echo $guardian->getName(); ?>
                    </p>
                    <p>
                        <?php echo $guardian->getFechaInicio(); ?>
                    </p>
                    <p>
                        <?php echo $guardian->getFechaFin(); ?>
                    </p>
                    <p>
                        <?php echo $guardian->getTamanio(); ?>
                    </p>
                    <p>
                        <?php echo $guardian->getRating(); ?>
                    </p>
                    <p>
                        <?php echo $guardian->getDescripcion(); ?>
                    </p>
                </div>
            <?php
            }

            ?>
        </div>
    </div>

    <div class="header">
        <div class="logo">
            <div>
                <img class="logo-icon" src="<?php echo IMG_PATH . 'PetHero.png' ?>" alt="logo">
                <p class="et">et</p>
                <p class="ero">ero</p>
            </div>
            <h1>PET HERO</h1>
        </div>
        <div class="options">
            <div class="ubication">
                <img src="<?php echo IMG_PATH . 'ubication.png' ?>" alt="location">
                <p>Ubicacion</p>
            </div>
            <button id='sidebar-bttn'>
                <img src="<?php echo IMG_PATH.'options.png' ?>" alt="options">
            </button>
        </div>
        <div id="sidebar" class="sidebar">
            <div class="sidebarUser">
                <img src="<?php echo IMG_PATH.'DefaultUserImg.png' ?>" alt="User">
                <p><?php echo $_SESSION['loggedUser']->getName() ?></p>
                <div class="line">&nbsp</div>
            </div>
            <div class="sidebarButtons">
                <a>
                    <img src="<?php echo IMG_PATH.'notificationIcon.png' ?>" alt="Notifications">
                    <p>Notificaciones</p>
                </a>
                <a href="<?php echo FRONT_ROOT.'User/PetsView' ?>">
                    <img src="<?php echo IMG_PATH.'petIcon.png' ?>" alt="My Pets">
                    <p>Mascotas</p>
                </a>
                <a>
                    <img src="<?php echo IMG_PATH.'supportIcon.png' ?>" alt="Support">
                    <p>Soporte</p>
                </a>
                <a>
                    <img src="<?php echo IMG_PATH.'configIcon.png' ?>" alt="Profile">
                    <p>Perfil</p>
                </a>
                <a href="<?php echo FRONT_ROOT.'Guardian/ShowRegisterView' ?>">
                    Queres ser guardian?
                </a>
            </div>
            <a href="<?php echo FRONT_ROOT.'User/Logout' ?>" class="logoutButton">
                <img src="<?php echo IMG_PATH.'logoutIcon.png' ?>" alt="Logout">
                Cerrar sesión
            </a>
            <button id="closeSidebar" class="closeSidebarButton">
                X
            </button>
        </div>
    </div>
    <script src="<?php echo JS_PATH.'sidebar.js' ?>" charset="utf-8"></script>
</body>
</html>