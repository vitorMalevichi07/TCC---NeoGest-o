document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var ListagemId = button.getAttribute('data-id');
    document.getElementById('inputIdExcluir').value = ListagemId;

    // Busca os dados via AJAX
    fetch('./modalFinanceiro/listagemContas/CRUD/dadosContas.php?id=' + ListagemId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_conta_del').value = data.descricao || '';
        });
});