<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Debit extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'amount',
        'description',
        'type',
        'date', 
        'image_path',
    ];


    protected $dates = ['date'];


    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
