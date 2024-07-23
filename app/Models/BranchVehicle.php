<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchVehicle extends Model
{
    use HasFactory;

    protected $table = 'branch_vehicle';

    protected $fillable = [
        'branch_id',
        'vehicle_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
