<?php

namespace App\Enums;

enum StepType: string
{
    case RODA = 'wheels';
    case LATARIA = 'bodywork';
    case FAROL = 'lights';
    case DOCUMENTO = 'document';

    public function string(): string
    {
        return match ($this) {
            self::RODA => 'Rodas',
            self::LATARIA => 'Lataria',
            self::FAROL => 'Farol',
            self::DOCUMENTO => 'Documento',
        };
    }
}
