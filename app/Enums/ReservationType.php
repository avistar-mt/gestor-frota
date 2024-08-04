<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ReservationType extends Enum
{
    const PENDENTE = 'pending';
    const APROVADO = 'approved';
    const NEGADO = 'canceled';
    const COMPLETADO = 'completed';
    const DESAPROVADO = 'disapproved';
    const EM_ANDAMENTO = 'ongoing';


    public static function getDescription($value): string
    {
        if ($value === self::PENDENTE) {
            return 'Pendente';
        }

        if ($value === self::APROVADO) {
            return 'Aprovado';
        }

        if ($value === self::NEGADO) {
            return 'Negado';
        }

        if ($value === self::COMPLETADO) {
            return 'Completo';
        }

        if ($value === self::DESAPROVADO) {
            return 'Desaprovado';
        }

        if ($value === self::EM_ANDAMENTO) {
            return 'Em andamento';
        }

        return parent::getDescription($value);
    }

}