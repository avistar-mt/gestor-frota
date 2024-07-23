<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function isAdmin() {
        return $this->name === 'Admin';
    }

    public function isAdminFrota() {
        return $this->name === 'Admin Frota';
    }

    public function isGestor() {
        return $this->name === 'Gestor';
    }

    public function isOperador() {
        return $this->name === 'Operador';
    }
}
