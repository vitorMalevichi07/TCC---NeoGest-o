document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var FluxoId = button.getAttribute('data-id');
    document.getElementById('inputIdExcluir').value = FluxoId;

    // Busca os dados via AJAX
    fetch('./modalFinanceiro/fluxoFinanceiro/CRUD/dadosFluxo.php?id=' + FluxoId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_del').value = data.descr || '';
        });
});