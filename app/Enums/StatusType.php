<?php

namespace App\Enums;
use BenSampo\Enum\Enum;


enum StatusType : string
{
    case DISPONIVEL = 'available';
    case ALUGADO = 'rented';
    case MANUTENCAO = 'maintenance';

    // 'pending', 'approved', 'completed', 'disapproved', 'ongoing', 'canceled'

    case PENDENTE = 'pending';

    case APROVADO = 'approved';

    case NEGADO = 'canceled';

    case COMPLETADO = 'completed';

    case DESAPROVADO = 'disapproved';

    case EM_ANDAMENTO = 'ongoing';

    
    
    public function string() 
    {
        return match($this) {
            self::DISPONIVEL => 'Disponível',
            self::ALUGADO => 'Alugado',
            self::MANUTENCAO => 'Manutenção',
            self::PENDENTE => 'Pendente',
            self::APROVADO => 'Aprovado',
            self::NEGADO => 'Negado',
            self::COMPLETADO => 'Completo',
            self::DESAPROVADO => 'Desaprovado',
            self::EM_ANDAMENTO => 'Em andamento',
        };
    }

    public function color() {

        return match($this) {
            self::DISPONIVEL => 'success',
            self::ALUGADO => 'warning',
            self::MANUTENCAO => 'danger',
            self::PENDENTE => 'warning',
            self::APROVADO => 'success',
            self::NEGADO => 'danger',
            self::COMPLETADO => 'success',
            self::DESAPROVADO => 'danger',
            self::EM_ANDAMENTO => 'info',
        };

    }
}