$(document).on('input', '#email_cli_edit, #emailCli', function () {
    $(this).removeClass('is-valid is-invalid');
    $(this).css({ 'pointer-events': 'auto', 'opacity': '1' });
});

$(document).on('blur', '#email_cli_edit', function () {
    const email = $(this).val().trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    $(this).removeClass('is-valid is-invalid');
    if (email && !regex.test(email)) {
        $(this).addClass('is-invalid');
    } else if (email) {
        $(this).addClass('is-valid');
    }
});

////////////////////////////////////////////////////////////////////// Fim da validação do email para edição de cliente////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////// Início da validação do email para cadastro de cliente////////////////////////////////////////////////////////

$(document).on('blur', '#emailCli', function () {
    const email = $(this).val().trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    $(this).removeClass('is-valid is-invalid');
    if (email && !regex.test(email)) {
        $(this).addClass('is-invalid');
    } else if (email) {
        $(this).addClass('is-valid');
    }
});