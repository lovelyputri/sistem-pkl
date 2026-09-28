<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nisn',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon',
        'nama_sekolah',
        'jurusan',
        'kelas',
        'tempat_pkl',
        'tanggal_mulai_pkl',
        'tanggal_selesai_pkl',

    ];

    protected $casts = [

        'tanggal_lahir' => 'date',
        'tanggal_mulai_pkl' => 'date',
        'tanggal_selesai_pkl' => 'date',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
