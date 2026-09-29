<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $fillable = [
        'nama_jurusan',
    ];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}
