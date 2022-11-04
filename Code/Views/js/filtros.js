const botonFecha = document.getElementById('filtroFecha');
const boxFiltro = document.getElementById('boxFiltro');
const botonCerrar = document.getElementById('cerrarBox');
const buscarButton = document.getElementById('buscarButton');

botonFecha.addEventListener('click', () => {
    boxFiltro.classList.toggle('boxDisplay');
});

botonCerrar.addEventListener('click', () => {
    boxFiltro.classList.toggle('boxDisplay');
});