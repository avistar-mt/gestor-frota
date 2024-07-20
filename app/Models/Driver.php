<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
