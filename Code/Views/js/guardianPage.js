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

chatButton.addEventListener('click', (event) => {
    event.preventDefault();
    boxMensaje.classList.remove('hide');
});

boxMensaje.classList.add('hide');