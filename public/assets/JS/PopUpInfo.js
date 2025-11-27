const openBtn = document.getElementById('openPopUpInfo');
const closeBtn = document.getElementById('closePopUpInfo');
const modal = document.getElementById('modalInfo');

openBtn.addEventListener('click', (event) => {
    event.preventDefault();
    modalInfo.style.display = 'block'; 
});

closeBtn.addEventListener('click', () => {
    modalInfo.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === modalInfo) {
        modalInfo.style.display = 'none'; 
    }
});