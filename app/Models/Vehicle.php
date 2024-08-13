<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusType;
use Database\Factories\VehicleFactory;

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

    protected $casts = [
        'status' => StatusType::class,
    ];

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_vehicle');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return VehicleFactory::new();
    }
}
