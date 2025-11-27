document.getElementById('modalEditar').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var agendamentoId = button.getAttribute('data-id');
    document.getElementById('inputIdEditar').value = agendamentoId;

    // Busca os dados via AJAX
    fetch('./modalAgendamento/CRUD/updateAgendamento.php?id=' + agendamentoId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('cliente_agend_edit').value = data.nome_cliente + ' ' + data.sobrenome_cliente || '';
            document.getElementById('quadra_edit').value = String(data.id_quadra) || 'selecione uma opção';
            document.getElementById('data_agendamento_edit').value = data.dt || '';
            document.getElementById('horario_agend_edit').value = data.horario_agendado || '';
            document.getElementById('horario_fim_agend_edit').value = data.tempo_alocado || '';
            document.getElementById('valor_agend_edit').value = data.valor || '';
            document.getElementById('estado_cont_agend_edit').value = data.estado_conta || 'selecione uma opção';
        });
});