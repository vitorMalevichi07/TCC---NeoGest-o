$(document).on('input', '#cnpjCli', function () {
    let cnpj = $(this).val().replace(/\D/g, '').slice(0, 14);
    if (cnpj.length > 12) {
        cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})/, "$1.$2.$3/$4-$5");
    } else if (cnpj.length > 8) {
        cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{1,4})/, "$1.$2.$3/$4");
    } else if (cnpj.length > 5) {
        cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (cnpj.length > 2) {
        cnpj = cnpj.replace(/^(\d{2})(\d{1,3})/, "$1.$2");
    }
    $(this).val(cnpj);
});
$(document).on('blur', '#cnpjCli', function () {
    let cnpj = $(this).val().replace(/\D/g, '');
    let $input = $(this);
    $input.removeClass('is-valid is-invalid');
    if (cnpj.length !== 14 || /^(\d)\1+$/.test(cnpj)) {
        $input.addClass('is-invalid');
        return;
    }

    // Validação de dígitos verificadores

    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) {
        $input.addClass('is-invalid');
        return;
    }
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)) {
        $input.addClass('is-invalid');
        return;
    }
    $input.addClass('is-valid');
});
///////////////////////////////////////////////////////////////////// Fim da validação do CNPJ para cadastro de cliente////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////// Início da validação do CNPJ para edição de cliente////////////////////////////////////////////////////////
$(document).on('input', '#cnpj_cli_edit', function () {
    let cnpj = $(this).val().replace(/\D/g, '').slice(0, 14);
    if (cnpj.length > 12) {
        cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})/, "$1.$2.$3/$4-$5");
    } else if (cnpj.length > 8) {
        cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{1,4})/, "$1.$2.$3/$4");
    } else if (cnpj.length > 5) {
        cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (cnpj.length > 2) {
        cnpj = cnpj.replace(/^(\d{2})(\d{1,3})/, "$1.$2");
    }
    $(this).val(cnpj);
});
$(document).on('blur', '#cnpj_cli_edit', function () {
    let cnpj = $(this).val().replace(/\D/g, '');
    let $input = $(this);
    $input.removeClass('is-valid is-invalid');
    if (cnpj.length !== 14 || /^(\d)\1+$/.test(cnpj)) {
        $input.addClass('is-invalid');
        return;
    }

    // Validação de dígitos verificadores

    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) {
        $input.addClass('is-invalid');
        return;
    }
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)) {
        $input.addClass('is-invalid');
        return;
    }
    $input.addClass('is-valid');
});