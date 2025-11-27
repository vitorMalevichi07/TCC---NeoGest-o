$(document).on('input', '#cpfCli', function () {
    let cpf = $(this).val().replace(/\D/g, '').slice(0, 11);
    if (cpf.length > 9) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
    } else if (cpf.length > 6) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (cpf.length > 3) {
        cpf = cpf.replace(/^(\d{3})(\d{1,3})/, "$1.$2");
    }
    $(this).val(cpf);
});

$(document).on('input', '#cpfCli', function () {
    let cpf = $(this).val().replace(/\D/g, '').slice(0, 11);
    if (cpf.length > 9) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
    } else if (cpf.length > 6) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (cpf.length > 3) {
        cpf = cpf.replace(/^(\d{3})(\d{1,3})/, "$1.$2");
    }
    $(this).val(cpf);
    // Remove validação visual enquanto digita
    $(this).removeClass('is-valid is-invalid');
});

$(document).on('blur', '#cpfCli', function () {
    let cpf = $(this).val().replace(/\D/g, '');
    let $input = $(this);
    $input.removeClass('is-valid is-invalid');
    if (cpf.length !== 11) {
        $input.addClass('is-invalid');
        return;
    }
    // Validação simples de CPF
    let soma = 0;
    let resto;
    if (/^(\d)\1+$/.test(cpf)) {
        $input.addClass('is-invalid');
        return;
    }
    for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if ((resto === 10) || (resto === 11)) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) {
        $input.addClass('is-invalid');
        return;
    }
    soma = 0;
    for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if ((resto === 10) || (resto === 11)) resto = 0;
    if (resto !== parseInt(cpf.substring(10, 11))) {
        $input.addClass('is-invalid');
        return;
    }
    // CPF válido
    $input.addClass('is-valid');
});
/////////////////////////////////////////////// Fim da validação do CPF para o cadastro ///////////////////////////////////////////////
//////////////////////////////////////////// Inicio da validação do CPF para a edição ///////////////////////////////////////////////
$(document).on('input', '#cpf_cli_edit', function () {
    let cpf = $(this).val().replace(/\D/g, '').slice(0, 11);
    if (cpf.length > 9) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
    } else if (cpf.length > 6) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (cpf.length > 3) {
        cpf = cpf.replace(/^(\d{3})(\d{1,3})/, "$1.$2");
    }
    $(this).val(cpf);
});

$(document).on('input', '#cpf_cli_edit', function () {
    let cpf = $(this).val().replace(/\D/g, '').slice(0, 11);
    if (cpf.length > 9) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
    } else if (cpf.length > 6) {
        cpf = cpf.replace(/^(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (cpf.length > 3) {
        cpf = cpf.replace(/^(\d{3})(\d{1,3})/, "$1.$2");
    }
    $(this).val(cpf);
    // Remove validação visual enquanto digita
    $(this).removeClass('is-valid is-invalid');
});

$(document).on('blur', '#cpf_cli_edit', function () {
    let cpf = $(this).val().replace(/\D/g, '');
    let $input = $(this);
    $input.removeClass('is-valid is-invalid');
    if (cpf.length !== 11) {
        $input.addClass('is-invalid');
        return;
    }
    // Validação simples de CPF
    let soma = 0;
    let resto;
    if (/^(\d)\1+$/.test(cpf)) {
        $input.addClass('is-invalid');
        return;
    }
    for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if ((resto === 10) || (resto === 11)) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) {
        $input.addClass('is-invalid');
        return;
    }
    soma = 0;
    for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if ((resto === 10) || (resto === 11)) resto = 0;
    if (resto !== parseInt(cpf.substring(10, 11))) {
        $input.addClass('is-invalid');
        return;
    }
    // CPF válido
    $input.addClass('is-valid');
});    