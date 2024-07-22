<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'reservation_star',
        'reservation_end',
        'status',
        'approved_by',
        'branch_id',
        'driver_id'
    ];

    protected $dates = [
        'reservation_star',
        'reservation_end',
    ];

    public function setReservationStarAttribute($value)
    {
        $this->attributes['reservation_star'] = Carbon::createFromFormat('d-m-Y H:i', $value)->format('Y-m-d H:i:s');
    }

    public function setReservationEndAttribute($value)
    {
        $this->attributes['reservation_end'] = Carbon::createFromFormat('d-m-Y H:i', $value)->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
