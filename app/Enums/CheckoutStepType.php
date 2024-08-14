<?php

namespace App\Enums;

enum CheckoutStepType: string
{

    case LADO_DIREITO_FRONTAL = 'lado_direito_frontal';
    case LADO_ESQUERDO_FRONTAL = 'lado_esquerdo_frontal';

    case LADO_DIREITO_TRASEIRO = 'lado_direito_traseiro';
    case LADO_ESQUERDO_TRASEIRO = 'lado_esquerdo_traseiro';

    public function string(): string
    {
        return match ($this) {
            self::LADO_DIREITO_FRONTAL => 'Lado Direito Frontal',
            self::LADO_ESQUERDO_FRONTAL => 'Lado Esquerdo Frontal',
            self::LADO_DIREITO_TRASEIRO => 'Lado Direito Traseiro',
            self::LADO_ESQUERDO_TRASEIRO => 'Lado Esquerdo Traseiro',
        };
    }
}
