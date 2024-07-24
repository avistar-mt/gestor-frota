<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'phone',
        'status',
        'birth_date',
        'cnh_number',
        'cnh_due_date',
        'cnh_category',
        'street',
        'number',
        'city',
        'state',
    ];

    protected $dates = [
        'birth_date',
        'cnh_due_date',
    ];

    public function setBirthDateAttribute($value)
    {

                $date = Carbon::createFromFormat('d/m/Y', trim($value));
                $this->attributes['birth_date'] = $date->setTimezone('America/Sao_Paulo')->format('Y-m-d');

    }

    public function getBirthDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }


    public function setCnhDueDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/Y', trim($value));
        $this->attributes['cnh_due_date'] = $date->setTimeStamp('America/Sao_Paulo')->format('Y-m-d');
    }

    public function getCnhDueDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

}
