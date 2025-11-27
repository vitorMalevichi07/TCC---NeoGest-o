$(document).on('input', '#rgCli', function() {
    let rg = $(this).val().replace(/\D/g, '').slice(0,9);
    if (rg.length > 7) {
        rg = rg.replace(/^(\d{2})(\d{3})(\d{3})(\d{1})/, "$1.$2.$3-$4");
    } else if (rg.length > 4) {
        rg = rg.replace(/^(\d{2})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (rg.length > 2) {
        rg = rg.replace(/^(\d{2})(\d{1,3})/, "$1.$2");
    }
    $(this).val(rg);
});