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