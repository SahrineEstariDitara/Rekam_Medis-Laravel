<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'user_id',
        'no_rm',
        'nama',
        'tempat_lahir',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_tlp',
        'keluhan',
        'tinggi_badan',
        'berat_badan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi inverse: Pasien belongsTo User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi One to Many: Pasien memiliki banyak Rekam Medis
     */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}
