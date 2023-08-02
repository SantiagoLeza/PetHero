const closeButtonReserva = document.getElementById('closeButtonReserva');
const boxReservar = document.getElementById('boxReserva');
const botonReserva = document.getElementById('botonReserva');

closeButtonReserva.addEventListener('click', () => {
    boxReservar.classList.add('hide');
});

botonReserva.addEventListener('click', () => {
    boxReservar.classList.remove('hide');
});

boxReservar.classList.add('hide');

const chatButton = document.getElementById('chat');
const boxMensaje = document.getElementById('boxMensaje');
const formMensaje = document.getElementById('formMensaje');
const inputMensaje = document.getElementById('inputMensaje');
const inputIdGuardian = document.getElementById('idGuardian');
const botonEnviar = document.getElementById('mandarMensaje');

chatButton.addEventListener('click', (event) => {
    event.preventDefault();
    boxMensaje.classList.remove('hide');
});

formMensaje.addEventListener('submit', (event) => {
    event.preventDefault();
    const mensaje = inputMensaje.value;
    const idGuardian = inputIdGuardian.value;
    if (mensaje.length > 0) {
        fetch('http://localhost:3000/User/nuevo_mensaje', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                mensaje,
                idGuardian
            })
        })
        .then(data => {
            window.location.href = 'http://localhost:3000/User/ShowChatView';
        })
    }
});

boxMensaje.classList.add('hide');