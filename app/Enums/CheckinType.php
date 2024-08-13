<?php

namespace App\Enums;

enum CheckinType: string
{

    case PENDENTE = 'pending';
    case APROVADO = 'approved';
    case NEGADO = 'rejected';

    public function getDescription(): string
    {
        return match ($this) {
            self::PENDENTE => 'Pendente',
            self::APROVADO => 'Aprovado',
            self::NEGADO => 'Negado',
        };
    }
}
