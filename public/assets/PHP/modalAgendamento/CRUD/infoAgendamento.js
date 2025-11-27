document.getElementById('modalInfo').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var agendamentoId = button.getAttribute('data-id');
    document.getElementById('inputIdInfo').value = agendamentoId;

    // Busca os dados via AJAX
    fetch('./modalAgendamento/CRUD/infoAgendamento.php?id=' + agendamentoId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('nome_cliente_info').value = data.nome_cliente || '';
            document.getElementById('sobrenome_cliente_info').value = data.sobrenome_cliente || 'Vazio';
            document.getElementById('quadra_cliente_info').value = data.id_quadra || 'Vazio';
            document.getElementById('data_agendamento_info').value = data.dt || '';
            document.getElementById('horario_agendamento_info').value = data.horario_agendado || '';
            document.getElementById('horario_fim_agendamento_info').value = data.tempo_alocado || '';
            document.getElementById('valor_agendamento_info').value = data.valor || '';
            document.getElementById('estadoContaAgend_info').value = data.estado_conta || 'Vazio';
        });
});