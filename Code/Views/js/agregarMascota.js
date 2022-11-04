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

const selectTipo = document.getElementById('selectTipo');
const radioPerro = document.getElementById('perro');
const radioGato = document.getElementById('gato');
const selectRazaPerro = document.getElementById('razaPerro');
const selectRazaGato = document.getElementById('razaGato');
const selectContainer = document.getElementById('selectContainer');

selectRazaGato.remove();

selectTipo.addEventListener('change', function() {
    if (selectTipo.value == 'perro') {
        selectRazaGato.remove();
        selectContainer.appendChild(selectRazaPerro);
    }
    if (selectTipo.value == 'gato') {
        selectRazaPerro.remove();
        selectContainer.appendChild(selectRazaGato);
    }
});