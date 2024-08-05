<?php

namespace App\Enums;

 enum CheckinType : string
{

    case PENDENTE = 'pending';

    case APROVADO = 'approved';

    case NEGADO = 'rejected';


    public function getDescription(): string
    {
        if ($this === self::PENDENTE) {
            return 'Pendente';
        }

        if ($this === self::APROVADO) {
            return 'Aprovado';
        }

        if ($this === self::NEGADO) {
            return 'Negado';
        }
    }

}