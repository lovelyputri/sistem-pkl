<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'guru_id',
        'sekolah_id',
        'jurusan_id',
        'kelas_id',
        'nama_lengkap',
        'foto_profil',
        'alamat',
        'tempat_lahir',
        'nisn',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon',
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

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
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

    public function jurnals(): HasMany
    {
        return $this->hasMany(Jurnal::class);
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }
}