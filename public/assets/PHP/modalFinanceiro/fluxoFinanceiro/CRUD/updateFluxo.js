document.getElementById('modalEditar').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var FluxoId = button.getAttribute('data-id');
    document.getElementById('inputIdEditar').value = FluxoId;

    // Busca os dados via AJAX
    fetch('./modalFinanceiro/fluxoFinanceiro/CRUD/dadosFluxo.php?id=' + FluxoId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_edit').value = data.descr || '';
            document.getElementById('categoria_edit').value = data.categoria || '';
            document.getElementById('tipo_edit').value = data.tipo;
            document.getElementById('valor_edit').value = data.valor || '';
            document.getElementById('dt_edit').value = data.dt || '';
        });
});