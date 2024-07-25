<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservationsExport implements FromCollection, WithHeadings
{
   
    
    protected $reservations;

    public function __construct($reservations)
    {
        $this->reservations = $reservations;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->reservations;
    }

    function headings(): array
    {
        return [
            'ID',
            'Data Inicio Reserva',
            'Data Fim Reserva',
            'Placa',
            'Motorista', 
            'Filial',
            'Status',
            'Motivo',
            'Data Criação',
            'Data Atualização',
        ];
    }
}
