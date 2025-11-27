document.getElementById('modalEditar').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var ListagemId = button.getAttribute('data-id');
    document.getElementById('inputIdEditar').value = ListagemId;

    // Busca os dados via AJAX
    fetch('./modalFinanceiro/listagemContas/CRUD/updateContas.php?id=' + ListagemId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('descr_conta').value = data.descricao || '';
            document.getElementById('categoria').textContent = data.categoria || 'nada';
            document.getElementById('recorrencia').textContent = data.recorrencia || '';
            document.getElementById('valor_conta').value = data.valor || '';
            document.getElementById('data_vencimento').value = data.data_vencimento || '';
            document.getElementById('tipo').value = data.valor_agendamento || '';
            document.getElementById('cpf_cnpj').value = data.cpf_cnpj || '';
            document.getElementById('observacao_conta').value = data.observacao || '';
        });
});