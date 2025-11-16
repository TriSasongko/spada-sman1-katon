<?php

namespace App\Notifications;

use App\Models\Materi;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MateriBaruNotification extends Notification
{
    use Queueable;

    public function __construct(public Materi $materi)
    {
    }

    public function via($notifiable)
    {
        return ['database']; // atau ['mail', 'database']
    }

    public function toArray($notifiable)
    {
        return [
            'judul' => $this->materi->judul,
            'kelas' => $this->materi->kelas->nama,
            'guru'  => $this->materi->guru->nama,
        ];
    }
}
