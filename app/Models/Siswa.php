<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'sekolah_id',
        'jurusan_id',
        'kelas_id',
        'nama_lengkap',
        'nisn',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon',
        'tempat_pkl',
        'tanggal_mulai_pkl',
        'tanggal_selesai_pkl',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_mulai_pkl' => 'date',
        'tanggal_selesai_pkl' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
}
