<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'location',
        'phone',
        'language',
        'skills',
        'role_id',
        'birthday',
        'avatar',
        'branch_id',
        'model_vehicle'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function ownReservations() {
        return $this->hasMany(Reservation::class, 'driver_id');
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function branch() {
        return $this->belongsToMany(Branch::class);
    }

    public function vehicles() {
        return $this->belongsToMany(Vehicle::class);
    }

    public function modelVehicle() {
        return $this->belongsToMany(ModelVehicle::class);
    }

    /**
     * Check if the user is admin
     */
    public function isAdmin() {
        return $this->role_id === 1;
    }

    public function isAdminFrota() {
        return $this->role_id === 2;
    }

    public function isGestor() {
        return $this->role_id === 3;
    }

    public function isOperation() {
        return $this->role_id === 4;
    }

    public function isDriver() {
        return $this->role_id === 5;
    }

    public function scopeAdmin($query): void {
        $query->where('role_id', 1);
    }

    public function scopeAdminFrota($query): void {
        $query->where('role_id', 2);
    }

    public function scopeGestor($query): void {
        $query->where('role_id', 3);
    }

    public function scopeOperation($query): void {
        $query->where('role_id', 4);
    }

    public function scopeDriver($query): void {
        $query->where('role_id', 5);
    }

    public function getNameAttribute() {
        return join(' ', array_filter([$this->firstname, $this->lastname]));
    }
}
