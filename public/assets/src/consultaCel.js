document.getElementById('cel_cli_edit').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 11) value = value.slice(0, 11);

    if (value.length > 0) {
        value = '(' + value;
    }
    if (value.length > 3) {
        value = value.slice(0, 3) + ') ' + value.slice(3);
    }
    if (value.length > 10) {
        value = value.slice(0, 10) + '-' + value.slice(10);
    }
    e.target.value = value;
});

///////


document.getElementById('celularCli').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 11) value = value.slice(0, 11);

    if (value.length > 0) {
        value = '(' + value;
    }
    if (value.length > 3) {
        value = value.slice(0, 3) + ') ' + value.slice(3);
    }
    if (value.length > 10) {
        value = value.slice(0, 10) + '-' + value.slice(10);
    }
    e.target.value = value;
});