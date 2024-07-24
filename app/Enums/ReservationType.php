<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Reservation extends Enum
{
    const PENDENTE = 'pending';
    const APROVADO = 'approved';
    const NEGADO = 'canceled';


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

        return parent::getDescription($value);
    }

}