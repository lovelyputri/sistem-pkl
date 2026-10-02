<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public function __construct(public string $token) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $expire = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        return (new MailMessage)
            ->subject('Reset Password Akun Kamu')
            ->greeting('Halo!')
            ->line('Kami menerima permintaan untuk mereset password akun kamu.')
            ->action('Buat Password Baru', $url)
            ->line("Tautan ini berlaku selama {$expire} menit.")
            ->line('Jika kamu tidak merasa meminta reset password, abaikan saja email ini.')
            ->salutation('Salam, ' . config('app.name'));
    }
}
