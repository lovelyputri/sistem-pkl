<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GuruReminderNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $jenis,
        public string $namaGuru,
        public string $tanggal
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $isAbsensi = $this->jenis === 'absensi';

        return [
            'reminder_type' => $this->jenis,
            'title' => $isAbsensi ? 'Pengingat Absensi' : 'Pengingat Jurnal Harian',
            'message' => $isAbsensi
                ? 'Guru pembimbing mengingatkan kamu untuk mengisi absensi hari ini.'
                : 'Guru pembimbing mengingatkan kamu untuk mengisi jurnal kegiatan hari ini.',
            'guru_name' => $this->namaGuru,
            'reminder_date' => $this->tanggal,
            'url' => $isAbsensi ? '/siswa/absensi' : '/siswa/jurnal',
        ];
    }
}
