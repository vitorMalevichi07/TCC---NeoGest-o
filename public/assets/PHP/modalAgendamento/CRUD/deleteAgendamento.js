document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var agendamentoId = button.getAttribute('data-id');
    document.getElementById('inputIdExcluir').value = agendamentoId;

    // Busca os dados via AJAX
    fetch('./modalAgendamento/CRUD/deleteAgendamento.php?id=' + agendamentoId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('nome_cliente_del').value = data.nome_cliente || '';
            document.getElementById('sobrenome_cliente_del').value = data.sobrenome_cliente || 'Vazio';
        });
});