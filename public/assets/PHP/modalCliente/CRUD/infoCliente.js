document.getElementById('modalInfo').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var clienteId = button.getAttribute('data-id');
    document.getElementById('inputIdInfo').value = clienteId;

    // Busca os dados via AJAX
    fetch('./modalCliente/CRUD/dadosCliente.php?id=' + clienteId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('name_cli_info').value = data.nome || '';
            document.getElementById('lastname_cli_info').value = data.sobrenome || '';
            document.getElementById('dataNasc_cli_info').value = data.dt_nascimento || '';
            document.getElementById('dataCadast_cli_info').value = data.data_cadastro || '';
            document.getElementById('email_cli_info').value = data.email || '';
            document.getElementById('cpf_cli_info').value = data.cpf || '';
            document.getElementById('cnpj_cli_info').value = data.cnpj || '';
            document.getElementById('cel_cli_info').value = data.celular || '';
            document.getElementById('cep_cli_info').value = data.cep || '';
            document.getElementById('cidade_cli_info').value = data.cidade || '';
            document.getElementById('uf_cli_info').value = data.uf || '';
            document.getElementById('rua_cli_info').value = data.rua || '';
            document.getElementById('numCasa_cli_info').value = data.nCasa || '';
            document.getElementById('complemento_cli_info').value = data.complemento || '';
        });
});