document.getElementById('modalInfo').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var quadraId = button.getAttribute('data-id');
    document.getElementById('inputIdEditar').value = quadraId;

    // Busca os dados via AJAX
    fetch('./modalQuadras/CRUD/buscaDadosQuadra.php?id=' + quadraId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_quadra_info').value = data.descr || '';
            document.getElementById('disp_quadra_info').value = data.disponibilidade;
            document.getElementById('mod_quadra_info').value = data.modalidade || '';
            document.getElementById('valor_quadra_info').value = data.valor_hora || '';
        });
});