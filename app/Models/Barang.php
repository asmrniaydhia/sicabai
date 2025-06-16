<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $fillable = ['sparepart_id', 'id_user', 'id_bengkel', 'merk', 'harga_jual','harga_jasa', 'stok'];

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id');
    }

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class, 'id_bengkel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}