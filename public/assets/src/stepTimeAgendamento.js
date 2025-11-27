function ajustarMinutosParaMultiploDe5(input) {
    let valor = input.value;
    if (valor) {
        let [hora, minuto] = valor.split(':');
        minuto = Math.round(parseInt(minuto, 10) / 5) * 5;
        if (minuto === 60) {
            minuto = 55;
        }
        input.value = `${hora.padStart(2, '0')}:${minuto.toString().padStart(2, '0')}`;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const camposTime = [
        document.getElementById('horarioAgend'),
        document.getElementById('horarioFimAgend'),
        document.getElementById('aberturaFuncio'),
        document.getElementById('fechamentoFuncio')
    ];
    camposTime.forEach(function (campo) {
        if (campo) {
            campo.setAttribute('step', '300'); // 300 segundos = 5 minutos
            campo.addEventListener('blur', function () {
                ajustarMinutosParaMultiploDe5(campo);
            });
        }
    });
});