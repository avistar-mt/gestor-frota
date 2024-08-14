<?php

namespace App\Enums;

enum Stage: string
{

    case PENDENTE = 'pending';
    case APROVADO = 'approved';
    case NEGADO = 'rejected';

    public function string(): string
    {
        return match ($this) {
            self::PENDENTE => 'Pendente',
            self::APROVADO => 'Aprovado',
            self::NEGADO => 'Negado',
        };
    }
}
