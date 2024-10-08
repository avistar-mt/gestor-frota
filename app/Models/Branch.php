<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
        'headquarter_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'branch_vehicle');
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
