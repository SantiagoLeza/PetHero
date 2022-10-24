const botonAgregarMascota = document.getElementById('agregarMascotaBoton');
const botonCerrar = document.getElementById('closeForm');
const form = document.getElementById('formMascota');

botonAgregarMascota.addEventListener('click', function() {
    console.log("mostrar")
    form.classList.add('showForm');
    document.body.classList.toggle('opacity');
});

botonCerrar.addEventListener('click', function() {
    console.log("cerrar")
    form.classList.remove('showForm');
    document.body.classList.toggle('opacity');
});


const inputPerro = document.getElementById('perro');
const inputGato = document.getElementById('gato');
const selectTamanio = document.getElementById('div-tamanio');

inputPerro.addEventListener('click', function() {
    console.log("show")
    selectTamanio.classList.remove('hideSelect');
});

inputGato.addEventListener('click', function() {
    console.log("hide")
    selectTamanio.classList.add('hideSelect');
});