<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bengkel extends Model
{
    use HasFactory;

    protected $table = 'bengkel';

    protected $fillable = [
        'id_user', 'nama', 'whatsapp', 'jenis_bengkel', 'foto_bengkel',
        'alamat', 'jasa_penjemputan', 'jam_buka', 'jam_tutup', 'hari_libur',
        'latitude', 'longitude',
    ];

    protected $casts = [
        'hari_libur' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_bengkel');
    }
    
    
}
