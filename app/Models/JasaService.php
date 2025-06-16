<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JasaService extends Model
{
    public function jasa() // (nama relasi ke induknya)
    {
        return $this->belongsTo(Jasa::class);
    }

    // Jangan lupa tambahkan $fillable
    protected $fillable = [
        'jasa_id',
        'nama_jasa',
        'harga_jasa',
    ];
}
