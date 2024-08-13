<?php

namespace App\Enums;

enum ReservationType: string
{
    const PENDENTE = 'pending';
    const APROVADO = 'approved';
    const NEGADO = 'canceled';
    const COMPLETADO = 'completed';
    const DESAPROVADO = 'disapproved';
    const EM_ANDAMENTO = 'ongoing';

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
