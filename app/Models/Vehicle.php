<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusType;   

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'model',
        'year',
        'color',
        'renavam',
        'description',
        'tracker_number',
        'status',
    ];

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_vehicle');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
