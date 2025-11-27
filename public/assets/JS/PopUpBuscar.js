const openBtn = document.getElementById('openPopUpBuscar');
const closeBtn = document.getElementById('closePopUpBuscar');
const modal = document.getElementById('modalBuscar');

openBtn.addEventListener('click', (event) => {
    event.preventDefault(); 
    modalBuscar.style.display = 'block'; 
});

closeBtn.addEventListener('click', () => {
    modalBuscar.style.display = 'none'; 
});

window.addEventListener('click', (event) => {
    if (event.target === modalBuscar) {
        modalBuscar.style.display = 'none'; 
    }
});