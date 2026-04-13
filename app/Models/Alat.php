<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alats';
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'stok'
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
