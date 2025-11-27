const openBtn = document.getElementById('openPopUp');
const closeBtn = document.getElementById('closePopUp');
const modal = document.getElementById('modal');

// Exibe o modal ao clicar no botão "Contato"
openBtn.addEventListener('click', (event) => {
    event.preventDefault(); // Previne o comportamento padrão do link
    modal.style.display = 'block'; // Exibe o modal
});

// Oculta o modal ao clicar no botão "Fechar"
closeBtn.addEventListener('click', () => {
    modal.style.display = 'none'; // Oculta o modal
});

// Fecha o modal ao clicar fora dele
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none'; // Oculta o modal
    }
});