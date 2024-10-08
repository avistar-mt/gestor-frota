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
        'branch_id',
    ];

    protected $casts = [
        'status' => StatusType::class,
    ];

    public function models()
    {
        return $this->belongsTo(ModelVehicle::class);
    }


    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_vehicle');
    }

    // public function branches()
    // {
    //     return $this->belongsToMany(Branch::class);
    // }

    public function users()
    {
        return $this->belongsToMany(User::class, 'vehicle_user');
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
