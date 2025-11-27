const openBtn = document.getElementById('openPopUpExcluir');
const closeBtn = document.getElementById('closePopUpExcluir');
const modal = document.getElementById('modalExcluir');

openBtn.addEventListener('click', (event) => {
    event.preventDefault(); 
    modalExcluir.style.display = 'block'; 
});

closeBtn.addEventListener('click', () => {
    modalExcluir.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === modalExcluir) {
        modalExcluir.style.display = 'none'; 
    }
});