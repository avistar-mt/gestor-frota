
// Função para aplicar a máscara no CPF
function formatCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
    cpf = cpf.replace(/^(\d{3})(\d)/, '$1.$2'); // Adiciona ponto após o terceiro dígito
    cpf = cpf.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3'); // Adiciona ponto após o sexto dígito
    cpf = cpf.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4'); // Adiciona hífen após o nono dígito
    return cpf;
}

// Função para validar o CPF
function validateCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    var sum = 0;
    var rest;

    for (var i = 1; i <= 9; i++) {
        sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    rest = (sum * 10) % 11;

    if ((rest === 10) || (rest === 11)) {
        rest = 0;
    }

    if (rest !== parseInt(cpf.substring(9, 10))) {
        return false;
    }

    sum = 0;

    for (var i = 1; i <= 10; i++) {
        sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    rest = (sum * 10) % 11;

    if ((rest === 10) || (rest === 11)) {
        rest = 0;
    }

    if (rest !== parseInt(cpf.substring(10, 11))) {
        return false;
    }

    return true;
}


// Função para formatar a placa
function formatPlaca(placa) {
    placa = placa.replace(/\W/g, ''); // Remove caracteres não alfanuméricos
    placa = placa.replace(/^(\w{3})(\w{4})$/, '$1$2'); // Remove o hífen após os três primeiros caracteres
    return placa;
}

// Função para validar a placa
function validatePlaca(placa) {
    regex = /^[A-Za-z]{3}-?[A-Za-z0-9]{1}[0-9]{3}$/;
    if (!regex.test(placa)) {
        return false;
    }

    if (placa.length > 7) {
        return false;
    }

    return true;
}

// Exporta as funções para serem utilizadas em outros scripts
export { formatCPF, validateCPF, formatPlaca, validatePlaca };
