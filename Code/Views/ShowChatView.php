<?php
    require_once(VIEWS_PATH."sidebar.php");
    $chats = json_encode($chat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chats</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>chats.css">
</head>
<body>
    <div id="content">
        <div>
            <h1>Chats</h1>
            <div id="chatContainer">

            </div>
        </div>

        <div>
            <h1>Mensajes</h1>
            <div id="mensajesContainer">

            </div>
            <form id="inputMensajeForm">
                <input type="text" name="inputMensaje" id="inputMensaje">
            </form>
        </div>
    </div>
    <script>
        var chats = <?php echo $chats; ?>;

        var selectedId = chats[0]?.chatId || -1;

        var chat;

        const content = document.getElementById("content");
        const inputMensaje = document.getElementById("inputMensaje");

        if(selectedId !== -1){
            chat = getMesajesByChatId(selectedId);
            createElementMensajes(chat);
        }
        else{
            content.removeChild(inputMensaje);
        }

        const inputMensajeForm = document.getElementById("inputMensajeForm");
        inputMensajeForm.addEventListener("submit", function(e){
            e.preventDefault();
            let mensaje = inputMensaje.value;
            inputMensaje.value = "";
            addMensaje(mensaje, selectedId);
        });

        function createElementTable(data){
            let chatContainer = document.getElementById("chatContainer");
            let mensajesContainer = document.getElementById("mensajesContainer");
            for (let i = 0; i < data.length; i++) {
                let div = document.createElement("div");
                if(data[i].idDuenio == <?php echo $_SESSION["loggedUser"]->getIdUsuario(); ?>){
                    div.innerHTML = data[i].nombreGuardian + " - " + "(guardian)";
                }
                else{
                    div.innerHTML = data[i].nombreDuenio + " - " + "(duenio)";
                }
                div.addEventListener("click", function(){
                    selectedId = data[i].chatId;
                    chat = getMesajesByChatId(selectedId);
                    updateElementMensajes(chat);
                    mensajesContainer.scrollTop = mensajesContainer.scrollHeight;
                });
                chatContainer.appendChild(div);
                mensajesContainer.scrollTop = mensajesContainer.scrollHeight;
            }
        }

        function createElementMensajes(data){
            let mensajesContainer = document.getElementById("mensajesContainer");
            for (let i = 0; i < data.length; i++) {
                let div = document.createElement("div");
                let p = document.createElement("p");
                p.innerHTML = data[i].texto;
                div.appendChild(p);
                mensajesContainer.appendChild(div);
                if(data[i].idRemitente == <?php echo $_SESSION["loggedUser"]->getIdUsuario(); ?>){
                    div.classList.add("mensaje-usuario");
                }
                else{
                    div.classList.add("mensaje-entrante");
                }
            }
        }

        function updateElementMensajes(data){
            let mesajesContainer = document.getElementById("mensajesContainer");
            mesajesContainer.innerHTML = "";
            createElementMensajes(data);
        }


        function getMesajesByChatId(idChat){
            //send a request to local host port 3000 on the route /User/GetMensajesByChatId with the given parameter and return the response
            var request = new XMLHttpRequest();
            request.open('GET', 'http://localhost:3000/User/GetMensajesByChatId/' + idChat, false);  // `false` makes the request synchronous
            request.send(null);
            if (request.status === 200) {
                return JSON.parse(request.responseText);
            }
        }

        setInterval(() => {
            if(selectedId !== -1){
                chat = getMesajesByChatId(selectedId);
                updateElementMensajes(chat);
            }
        }, 1000);

        

        function addMensaje(mensaje, idChat){
            fetch('http://localhost:3000/User/addMensaje', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    mensaje: mensaje,
                    idChat: idChat
                }),
            })
            .then(data => {
                chat = getMesajesByChatId(selectedId);
                updateElementMensajes(chat);
                let mensajesContainer = document.getElementById("mensajesContainer");
                mensajesContainer.scrollTop = mensajesContainer.scrollHeight;
            })
        }

        createElementTable(chats);
    </script>
</body>
</html>