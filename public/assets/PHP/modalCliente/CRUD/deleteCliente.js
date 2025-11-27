document.getElementById('modalExcluir').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var clienteId = button.getAttribute('data-id');
    document.getElementById('inputIdExcluir').value = clienteId;

    // Busca os dados via AJAX
    fetch('./modalCliente/CRUD/dadosCliente.php?id=' + clienteId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('nome_cliente_del').value = data.nome || '';
            document.getElementById('sobrenome_cliente_del').value = data.sobrenome || '';
        });
});