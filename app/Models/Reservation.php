<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Checkin;

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


    protected $casts = [
        'reservation_star' => 'datetime',
        'reservation_end' => 'datetime',
        'status' => StatusType::class,
    ];

    public function setReservationStarAttribute($value)
    {
        $data = Carbon::createFromFormat('d/m/Y H:i', $value);
        $this->attributes['reservation_star'] = $data->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s');
    }

    // public function getReservationStarAttribute($value)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i:s');
    // }

    public function setReservationEndAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/Y H:i', $value);
        $this->attributes['reservation_end'] = $date->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s');
    }


    public function getReservationEndAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i:s');
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
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function debits()
    {
        return $this->hasMany(Debit::class);
    }

    public function checkins()
    {
        return $this->hasMany(Checkin::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
}
