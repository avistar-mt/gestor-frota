<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CheckinType;
use App\Enums\StepType;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservation_id',
        'step',
        'status'
    ];

    protected $casts = [
        'status' => CheckinType::class,
        'step' => StepType::class,
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    
}
