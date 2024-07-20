<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Reservation extends Enum
{
    const PENDENTE = 'pending';
    const APROVADO = 'approved';
    const NEGADO = 'canceled';

}