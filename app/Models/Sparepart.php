<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sparepart extends Model
{
    use HasFactory;
    protected $fillable = ['nama_sparepart', 'deskripsi'];
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'sparepart_id');
    }
}
