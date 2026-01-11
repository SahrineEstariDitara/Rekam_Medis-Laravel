<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';

    protected $fillable = [
        'rekam_medis_id',
        'obat_id',
        'jumlah',
        'dosis',
    ];

    /**
     * Relasi inverse: Resep belongsTo RekamMedis
     */
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }

    /**
     * Relasi inverse: Resep belongsTo Obat
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
