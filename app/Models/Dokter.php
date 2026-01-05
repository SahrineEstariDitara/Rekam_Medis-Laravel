<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'user_id',
        'nama',
        'spesialis',
    ];

    /**
     * Relasi inverse: Dokter belongsTo User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi One to Many: Dokter menangani banyak Rekam Medis
     */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}
