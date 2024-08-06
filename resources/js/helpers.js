
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

    if (cpf.length !== 11) {
        return false;
    }

    if (cpf === '00000000000' || cpf === '11111111111' || cpf === '22222222222' || cpf === '33333333333' || cpf === '44444444444' || cpf === '55555555555' || cpf === '66666666666' || cpf === '77777777777' || cpf === '88888888888' || cpf === '99999999999') {
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
// function validatePlaca(placa) {
//     regex = /^[A-Za-z]{3}-?[A-Za-z0-9]{1}[0-9]{3}$/;
//     if (!regex.test(placa)) {
//         return false;
//     }

//     if (placa.length > 7) {
//         return false;
//     }

//     return true;
// }

function validatePlaca(placa) {
    const regex = /^[A-Za-z]{3}-?[0-9]{4}$|^[A-Za-z]{3}-?[0-9][A-Za-z][0-9]{2}$/;
    return regex.test(placa);
}

export { formatCPF, validateCPF, formatPlaca, validatePlaca };
