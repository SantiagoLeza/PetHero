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
            <button id="closeSidebar">
                Cerrar
            </button>
        </div>
    </div>
    <script src="<?php echo JS_PATH.'sidebar.js' ?>" charset="utf-8"></script>

    <div class="content">
        <div class="filtros-container">
            <button>Filtrar por fecha</button>
            <button>Filtrar por estrellas</button>
            <button>Filtrar por precio</button>
            <button>Filtrar por ubicación</button>
            <button>Filtrar por fecha</button>
        </div>
    </div>
</body>
</html>