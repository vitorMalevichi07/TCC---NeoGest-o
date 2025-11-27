document.getElementById('modalInfo').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var FluxoId = button.getAttribute('data-id');
    document.getElementById('inputIdInfo').value = FluxoId;

    // Busca os dados via AJAX
    fetch('./modalFinanceiro/fluxoFinanceiro/CRUD/dadosFluxo.php?id=' + FluxoId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_info').value = data.descr || '';
            document.getElementById('categoria_info').value = data.categoria || '';
            document.getElementById('tipo_info').value = data.tipo;
            document.getElementById('valor_info').value = data.valor || '';
            document.getElementById('dt_info').value = data.dt || '';
        });
});