const openBtn = document.getElementById('openPopUpCadastro');
const closeBtn = document.getElementById('closePopUpCadastro');
const modal = document.getElementById('modalCadastro');

openBtn.addEventListener('click', (event) => {
    event.preventDefault();
    modalCadastro.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    modalCadastro.style.display = 'none'; 
});

window.addEventListener('click', (event) => {
    if (event.target === modalCadastro) {
        modalCadastro.style.display = 'none'; 
    }
});