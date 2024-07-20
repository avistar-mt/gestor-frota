<?php

namespace App\Enums;
use BenSampo\Enum\Enum;


final class StatusType extends Enum
{
    const DISPONIVEL = 'available';
    const ALUGADO = 'rented';
    const MANUTENCAO = 'maintenance';
    
    public function getStatusTypes()
    {
        return self::toArray();
    }
}