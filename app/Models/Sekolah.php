<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sekolah extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'alamat',
    ];

    public function gurus(): HasMany
    {
        return $this->hasMany(Guru::class);
    }

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}