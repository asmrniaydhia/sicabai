<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['id_bengkel', 'id_user', 'rating', 'ulasan'];

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class, 'id_bengkel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
