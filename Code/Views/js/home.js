const fechaFinInput = document.getElementById('fechaFin');
const fechaInicioInput = document.getElementById('fechaInicio');

fechaFinInput.addEventListener('change', (event) => {
    fechaFinInput.setAttribute('min', fechaInicioInput.value);
});

fechaInicioInput.addEventListener('change', (event) => {
    fechaInicioInput.setAttribute('max', fechaFinInput.value);
});