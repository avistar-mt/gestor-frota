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

    public function isSuperAdmin() {
        return $this->name === 'Super Admin';
    }

    public function isAdminFrota() {
        return $this->name === 'Admin Frota';
    }

    public function isGestor() {
        return $this->name === 'Gestor';
    }

    public function isSuperVisor() {
        return $this->name === 'Supervisor';
    }

    public function isOperador() {
        return $this->name === 'Operador';
    }

    public function isMotorista() {
        return $this->name === 'Motorista';
    }
}
