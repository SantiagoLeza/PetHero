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