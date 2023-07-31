const fechaFinInput = document.getElementById('fechaFin');
const fechaInicioInput = document.getElementById('fechaInicio');

fechaFinInput.addEventListener('change', (event) => {
    fechaFinInput.setAttribute('min', fechaInicioInput.value);
<<<<<<< HEAD
    fechaInicioInput.setAttribute('max', fechaFinInput.value);
=======
>>>>>>> 42c35813a94055cf1833bc9da474b7ca1ab4f024
});

fechaInicioInput.addEventListener('change', (event) => {
    fechaInicioInput.setAttribute('max', fechaFinInput.value);
<<<<<<< HEAD
    fechaFinInput.setAttribute('min', fechaInicioInput.value);
=======
>>>>>>> 42c35813a94055cf1833bc9da474b7ca1ab4f024
});