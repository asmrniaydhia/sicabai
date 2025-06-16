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
        'id_user',
        'id_bengkel',
        'jasa_id',
        'nama_jasa',
        'harga_jasa',
    ];

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class, 'id_bengkel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jasaService()
    {
        return $this->belongsTo(JasaService::class, 'jasa_id');
    }
}
