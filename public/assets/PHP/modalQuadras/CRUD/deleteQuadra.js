document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var quadraId = button.getAttribute('data-id');
    document.getElementById('inputIdExcluir').value = quadraId;

    // Busca os dados via AJAX
    fetch('./modalQuadras/CRUD/buscaDadosQuadra.php?id=' + quadraId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_quadra_del').value = data.descr || '';
            document.getElementById('mod_quadra_del').value = data.modalidade || '';
        });
});