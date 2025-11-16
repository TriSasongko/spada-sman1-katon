<?php

namespace App\Listeners;

use App\Events\MateriCreated;
use App\Notifications\MateriBaruNotification;

class SendMateriNotificationToStudents
{
    public function handle(MateriCreated $event)
    {
        $materi = $event->materi;

        // Ambil semua siswa dalam kelas materi tersebut
        $siswas = $materi->kelas->siswas;

        foreach ($siswas as $siswa) {
            $siswa->notify(new MateriBaruNotification($materi));
        }
    }
}
