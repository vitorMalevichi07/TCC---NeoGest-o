document.getElementById('modalEditar').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var funcionamentoId = button.getAttribute('data-id');
    document.getElementById('inputIdEditar').value = funcionamentoId;
    // Busca os dados via AJAX
    fetch('./modalFuncionamento/CRUD/dadosFuncionamento.php?id=' + funcionamentoId)
        .then(response => response.json())
        .then(data => {
            // Preenche os campos do modal com os dados recebidos
            document.getElementById('aberturaFuncio').value = data.h_abertura || '';
            document.getElementById('fechamentoFuncio').value = data.h_fechamento || '';
            document.getElementById('intervaloTempo').value = data.intervalo_tempo;
        });
});