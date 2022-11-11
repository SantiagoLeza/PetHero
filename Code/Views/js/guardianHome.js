const headerCancelados = document.getElementById('headerCancelados');
const contentCancelados = document.getElementById('contentCancelados');
const triangCancelados = document.getElementById('trianCancelados');

headerCancelados.addEventListener('click', () => {
    contentCancelados.classList.toggle('hidden');
    triangCancelados.classList.toggle('triangActive');
});

const headerPendientes = document.getElementById('headerPendientes');
const contentPendientes = document.getElementById('contentPendientes');
const triangPendientes = document.getElementById('trianPendientes');

headerPendientes.addEventListener('click', () => {
    contentPendientes.classList.toggle('hidden');
    triangPendientes.classList.toggle('triangActive');
});

const headerConfirmadas = document.getElementById('headerConfirmadas');
const contentConfirmadas = document.getElementById('contentConfirmadas');
const triangConfirmadas = document.getElementById('trianConfirmadas');

headerConfirmadas.addEventListener('click', () => {
    contentConfirmadas.classList.toggle('hidden');
    triangConfirmadas.classList.toggle('triangActive');
});

const headerEnCurso = document.getElementById('headerEnCurso');
const contentEnCurso = document.getElementById('contentEnCurso');
const triangEnCurso = document.getElementById('trianEnCurso');

headerEnCurso.addEventListener('click', () => {
    contentEnCurso.classList.toggle('hidden');
    triangEnCurso.classList.toggle('triangActive');
});

const headerFinalizadas = document.getElementById('headerFinalizadas');
const contentFinalizadas = document.getElementById('contentFinalizadas');
const triangFinalizadas = document.getElementById('trianFinalizadas');

headerFinalizadas.addEventListener('click', () => {
    contentFinalizadas.classList.toggle('hidden');
    triangFinalizadas.classList.toggle('triangActive');
});

contentCancelados.classList.toggle('hidden');
triangCancelados.classList.toggle('triangActive');

contentPendientes.classList.toggle('hidden');
triangPendientes.classList.toggle('triangActive');

contentConfirmadas.classList.toggle('hidden');
triangConfirmadas.classList.toggle('triangActive');

contentEnCurso.classList.toggle('hidden');
triangEnCurso.classList.toggle('triangActive');

contentFinalizadas.classList.toggle('hidden');
triangFinalizadas.classList.toggle('triangActive');