const fechaFinInput = document.getElementById('fechaFin');
const fechaInicioInput = document.getElementById('fechaInicio');

fechaFinInput.addEventListener('change', (event) => {
    fechaFinInput.setAttribute('min', fechaInicioInput.value);
    fechaInicioInput.setAttribute('max', fechaFinInput.value);
});

fechaInicioInput.addEventListener('change', (event) => {
    fechaInicioInput.setAttribute('max', fechaFinInput.value);
    fechaFinInput.setAttribute('min', fechaInicioInput.value);
<<<<<<< HEAD
});
=======
});
>>>>>>> 35af328607239ce7fdd56192f9ef78681b2cb224
