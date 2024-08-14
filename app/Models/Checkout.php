<?php

namespace App\Models;

use App\Enums\CheckoutStepType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Stage;
use App\Enums\StepType;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservation_id',
        'image',
        'step',
        'status'
    ];

    protected $casts = [
        'status' => Stage::class,
        'step' => CheckoutStepType::class,
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
