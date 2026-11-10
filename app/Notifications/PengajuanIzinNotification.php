<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengajuanIzinNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $judul,
        public string $pesan,
        public string $url,
        public string $jenis = 'pengajuan_izin'
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->judul,
            'message' => $this->pesan,
            'url' => $this->url,
            'type' => $this->jenis,
        ];
    }
}
