<?php

namespace App\Notifications;

use App\Models\Pengumuman;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PengumumanBaru extends Notification implements ShouldQueue
{
    use Queueable;

    protected Pengumuman $pengumuman;

    public function __construct(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    public function via($notifiable)
    {
        // kirim ke database + mail jika ada email
        return array_filter(['database', $notifiable->email ? 'mail' : null]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'pengumuman_id' => $this->pengumuman->id,
            'judul' => $this->pengumuman->judul,
            'isi' => \Str::limit(strip_tags($this->pengumuman->isi), 200),
            'url' => route('pengumuman.show', $this->pengumuman->id) ?? null,
        ];
    }

    public function toMail($notifiable)
    {
        $p = $this->pengumuman;

        $mail = (new MailMessage)
            ->subject("Pengumuman: {$p->judul}")
            ->line(\Str::limit(strip_tags($p->isi), 200))
            ->action('Lihat Pengumuman', url('/')); // ubah url kalau ada route frontend

        if ($p->file_path) {
            $mail->line('Lampiran tersedia di panel.');
        }

        return $mail;
    }
}
