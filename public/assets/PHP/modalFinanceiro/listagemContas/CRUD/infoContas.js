document.getElementById('modalInfo').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var ListagemId = button.getAttribute('data-id');
    document.getElementById('inputIdInfo').value = ListagemId;

    // Busca os dados via AJAX
    fetch('./modalFinanceiro/listagemContas/CRUD/dadosContas.php?id=' + ListagemId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_conta_info').value = data.descricao || '';
            document.getElementById('categoria_info').value = data.categoria || '';
            document.getElementById('recorrencia_info').value = data.recorrencia;
            document.getElementById('valor_conta_info').value = data.valor || '';
            document.getElementById('data_vencimento_info').value = data.data_vencimento || '';
            document.getElementById('tipo_info').value = data.tipo || '';
            document.getElementById('cpf_cnpj_info').value = data.cpf_cnpj || '';
            document.getElementById('observacao_conta_info').value = data.observacao || '';
        });
});