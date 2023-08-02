<?php
    // require_once(VIEWS_PATH."sidebar.php");
    $chats = json_encode($chat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <div id="content">
        <h1>Chats</h1>
        <div id="chatContainer">

        </div>

        <h1>Mensajes</h1>
        <div id="mensajesContainer">

        </div>
        <form id="inputMensajeForm">
            <input type="text" name="inputMensaje" id="inputMensaje">
        </form>
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
            for (let i = 0; i < data.length; i++) {
                let div = document.createElement("div");
                div.innerHTML = data[i].nombreDuenio + " - " + data[i].nombreGuardian;
                div.addEventListener("click", function(){
                    selectedId = data[i].chatId;
                    chat = getMesajesByChatId(selectedId);
                    updateElementMensajes(chat);
                });
                chatContainer.appendChild(div);
            }
        }

        function createElementMensajes(data){
            let mensajesContainer = document.getElementById("mensajesContainer");
            for (let i = 0; i < data.length; i++) {
                let div = document.createElement("div");
                div.innerHTML = data[i].texto;
                mensajesContainer.appendChild(div);
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

        createElementTable(chats);

        setInterval(() => {
            if(selectedId !== -1){
                chat = getMesajesByChatId(selectedId);
                updateElementMensajes(chat);
            }
            console.log(chat);
        }, 5000);

        

        function addMensaje(mensaje, idChat){
            //send a post request to local host port 3000 on the route /User/sendMensaje with the given parameters
            var request = new XMLHttpRequest();
            request.open('POST', 'http://localhost:3000/User/addMensaje', false);  // `false` makes the request synchronous
            request.setRequestHeader("Content-Type", "application/json");
            request.send(JSON.stringify({mensaje: mensaje, idChat: idChat}));
        }

        
    </script>
</body>
</html>