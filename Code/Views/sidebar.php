<link rel="stylesheet" href="<?php echo CSS_PATH ?>/sidebar.css">
<div class="header">
    <div class="logo">
        <div>
            <img class="logo-icon" src="<?php echo IMG_PATH . 'PetHero.png' ?>" alt="logo">
            <p class="et">et</p>
            <p class="ero">ero</p>
        </div>
        <h1><a href="<?php echo FRONT_ROOT.'Home/Home' ?>">PET HERO</a></h1>
    </div>
    <div class="options">
        <div class="ubication">
            <img src="<?php echo IMG_PATH . 'ubication.png' ?>" alt="location">
            <p><?php echo $_SESSION['loggedUser']->getDireccion() ?></p> 
        </div>
        <button id='sidebar-bttn'>
            <img src="<?php echo IMG_PATH.'options.png' ?>" alt="options">
        </button>
    </div>
    <div class="blindfold" id="blindfold">&nbsp</div>
        <div id="sidebar" class="sidebar">
            <div class="sidebarUser">
                <img src="<?php echo IMG_PATH.'DefaultUserImg.png' ?>" alt="User">
                <p><?php echo $_SESSION['loggedUser']->getName() ?></p>
                <div class="line">&nbsp</div>
            </div>
            <div class="sidebarButtons">
                <a href="<?php echo FRONT_ROOT.'User/ReservasView' ?>">
                    <img src="<?php echo IMG_PATH.'reserva.png' ?>" alt="Notifications">
                    <p>Reservas</p>
                </a>
                <a href="<?php echo FRONT_ROOT.'User/PetsView' ?>">
                    <img src="<?php echo IMG_PATH.'petIcon.png' ?>" alt="My Pets">
                    <p>Mascotas</p>
                </a>
                <a href="<?php echo FRONT_ROOT.'Guardian/ShowRegisterView' ?>">
                    <img src="<?php echo IMG_PATH.'cucha.png'?>" alt="Guardian">
                    <p>Guardian</p>
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
</div>