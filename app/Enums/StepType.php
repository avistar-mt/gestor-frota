<?php

namespace App\Enums;

 enum StepType : string
{

    case RODA = 'wheels';

    case LATARIA = 'bodywork';

    case FAROL = 'lights';

    case DOCUMENTO = 'document';


    public function getDescription(): string
    {
        if ($this === self::RODA) {
            return 'Rodas';
        }

        if ($this === self::LATARIA) {
            return 'Lataria';
        }

        if ($this === self::FAROL) {
            return 'Farol';
        }

        if($this === self::DOCUMENTO){
            return 'Documento';
        }
    }
}