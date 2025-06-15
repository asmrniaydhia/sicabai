<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['sparepart_id', 'merk', 'harga_jual', 'stok'];
    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }
}
