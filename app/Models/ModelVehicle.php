<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
