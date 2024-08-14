<?php

namespace App\Enums;

enum ReservationType: string
{
    case PENDENTE = 'pending';
    case APROVADO = 'approved';
    case NEGADO = 'canceled';
    case COMPLETADO = 'completed';
    case DESAPROVADO = 'disapproved';
    case EM_ANDAMENTO = 'ongoing';

    public function string(): string
    {
        return match ($this) {
            self::PENDENTE => 'Pendente',
            self::APROVADO => 'Aprovado',
            self::NEGADO => 'Negado',
            self::COMPLETADO => 'Completo',
            self::DESAPROVADO => 'Desaprovado',
            self::EM_ANDAMENTO => 'Em andamento',
        };
    }
}
