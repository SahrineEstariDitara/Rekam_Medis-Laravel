<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'keluhan',
        'diagnosa',
        'tindakan',
        'catatan',
        'tanggal_periksa',
    ];

    protected $casts = [
        'tanggal_periksa' => 'date',
    ];

    /**
     * Relasi inverse: RekamMedis belongsTo Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Relasi inverse: RekamMedis belongsTo Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    /**
     * Relasi One to Many: RekamMedis memiliki banyak Resep
     */
    public function resep()
    {
        return $this->hasMany(Resep::class);
    }
}
