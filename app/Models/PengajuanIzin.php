<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanIzin extends Model
{
    protected $table = 'pengajuan_izins';

    protected $fillable = [
        'siswa_id', 'guru_id', 'tanggal_mulai', 'tanggal_selesai',
        'jenis_izin', 'alasan', 'surat_path', 'status', 'catatan_guru',
        'diproses_oleh', 'diproses_pada',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'diproses_pada' => 'datetime',
    ];

    public function siswa(): BelongsTo { return $this->belongsTo(Siswa::class); }
    public function guru(): BelongsTo { return $this->belongsTo(Guru::class); }
    public function pemroses(): BelongsTo { return $this->belongsTo(User::class, 'diproses_oleh'); }
}
