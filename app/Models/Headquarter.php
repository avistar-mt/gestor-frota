<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    use HasFactory;

    protected $fillable = ['name'];



    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }
}
