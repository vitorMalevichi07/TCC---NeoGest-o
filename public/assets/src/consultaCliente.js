$(document).on('input', '#busca_cliente', function() {
    let termo = $(this).val();
    if (termo.length < 1) {
        $('#id_cliente').html('<option value="">Selecione um cliente</option>');
        return;
    }
    $.getJSON('../modalAgendamento/buscarClientes.php', { q: termo }, function(clientes) {
        let options = '<option value="">Selecione um cliente</option>';
        clientes.forEach(function(cliente) {
            options += `<option value="${cliente.id}">${cliente.nome}</option>`;
        });
        $('#id_cliente').html(options);
    });
});