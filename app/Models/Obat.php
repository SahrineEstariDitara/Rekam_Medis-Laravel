<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'nama_obat',
        'stok',
    ];

    /**
     * Relasi One to Many: Obat digunakan di banyak Resep
     */
    public function resep()
    {
        return $this->hasMany(Resep::class);
    }
}
