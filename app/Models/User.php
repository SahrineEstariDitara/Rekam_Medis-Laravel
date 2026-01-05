<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi One to One ke Pasien
     */
    public function pasien()
    {
        return $this->hasOne(Pasien::class);
    }

    /**
     * Relasi One to One ke Dokter
     */
    public function dokter()
    {
        return $this->hasOne(Dokter::class);
    }
}
