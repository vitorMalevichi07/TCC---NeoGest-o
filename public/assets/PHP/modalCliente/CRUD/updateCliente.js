document.getElementById('modalEditar').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var clienteId = button.getAttribute('data-id');
    document.getElementById('inputIdEditar').value = clienteId;

    // Busca os dados via AJAX
    fetch('./modalCliente/CRUD/dadosCliente.php?id=' + clienteId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('name_cli_edit').value = data.nome || '';
            document.getElementById('lastname_cli_edit').value = data.sobrenome || '';
            document.getElementById('dataNasc_cli_edit').value = data.dt_nascimento || '';
            document.getElementById('dataCadast_cli_edit').value = data.data_cadastro || '';
            document.getElementById('email_cli_edit').value = data.email || '';
            document.getElementById('cpf_cli_edit').value = data.cpf || '';
            document.getElementById('cnpj_cli_edit').value = data.cnpj || '';
            document.getElementById('cel_cli_edit').value = data.celular || '';
            document.getElementById('cep_cli_edit').value = data.cep || '';
            document.getElementById('cidade_cli_edit').value = data.cidade || '';
            document.getElementById('uf_cli_edit').value = data.uf || '';
            document.getElementById('rua_cli_edit').value = data.rua || '';
            document.getElementById('numCasa_cli_edit').value = data.nCasa || '';
            document.getElementById('complementos_cli_edit').value = data.complemento || '';
        });
});