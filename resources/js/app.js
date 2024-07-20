import PerfectScrollbar from 'perfect-scrollbar';
import { formatCPF, validateCPF, formatPlaca, validatePlaca } from './helpers';

window.PerfectScrollbar = PerfectScrollbar;

document.addEventListener('DOMContentLoaded', function () {
    var cpf = document.getElementById('cpf');
    if (cpf) {
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
});

require('./bootstrap');
require('./custom')

