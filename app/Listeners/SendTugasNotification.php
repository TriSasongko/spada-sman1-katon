<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTugasNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TugasCreated $event)
    {
        $tugas = $event->tugas;

        foreach ($tugas->kelas->siswas as $siswa) {
            $siswa->notify(new TugasBaruNotification($tugas));
        }
    }

}
