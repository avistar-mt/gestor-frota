import PerfectScrollbar from 'perfect-scrollbar';
import { formatCPF, validateCPF, formatPlaca, validatePlaca } from './helpers';

window.PerfectScrollbar = PerfectScrollbar;

document.addEventListener('DOMContentLoaded', function () {
    var cpf = document.getElementById('cpf');
    if (cpf) {
        cpf.addEventListener('blur', function () {
            if (!validateCPF(cpf.value)) {
                alert('CPF inválido');
            }
        });

        cpf.addEventListener('input', function () {
            cpf.value = formatCPF(cpf.value);
        });     
    }

    var placa = document.getElementById('plate');
    if (placa) {

        placa.addEventListener('blur', function () {
            if (!validatePlaca(placa.value)) {
                alert('Placa inválida');
            } 
        });

        placa.addEventListener('input', function () {
            placa.value = formatPlaca(placa.value);
        });

        
    }

    // Apply CPF mask logic on page load
    if (cpf) {
        cpf.value = formatCPF(cpf.value);
    }

    // Apply Plate mask logic on page load
    if (placa) {
        placa.value = formatPlaca(placa.value);
    }
    
});

// Apply CPF mask logic on page load
var cpf = document.getElementById('cpf');
if (cpf) {
    cpf.value = formatCPF(cpf.value);
}

// Apply Plate mask logic on page load
var placa = document.getElementById('plate');
if (placa) {
    placa.value = formatPlaca(placa.value);
}

require('./bootstrap');
require('./custom')

