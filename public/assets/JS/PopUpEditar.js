const openBtn = document.getElementById('openPopUpEditar');
const closeBtn = document.getElementById('closePopUpEditar');
const modalEditar = document.getElementById('modalEditar');

openBtn.addEventListener('click', (event) => {
    event.preventDefault();
    modalEditar.style.display = 'block'; 
});

closeBtn.addEventListener('click', () => {
    modalEditar.style.display = 'none'; 
});

window.addEventListener('click', (event) => {
    if (event.target === modalEditar) {
        modalEditar.style.display = 'none'; 
    }
});