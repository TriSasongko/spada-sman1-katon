<?php

namespace App\Listeners;

use App\Events\PengumumanCreated;
use App\Notifications\PengumumanBaru;
use App\Models\User;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class SendPengumumanNotifications implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PengumumanCreated $event): void
    {
        $p = $event->pengumuman;
        $recipients = $this->buildRecipients($p);

        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new PengumumanBaru($p));
        }
    }

    protected function buildRecipients($pengumuman): Collection
    {
        $target = $pengumuman->target ?? 'all_students';
        $ids = $pengumuman->target_ids ?? [];

        $users = collect();

        switch ($target) {
            case 'all_students':
                $users = User::where('role_id', 3)->get();
                break;

            case 'all_gurus':
                $users = User::where('role_id', 2)->get();
                break;

            case 'all':
                $users = User::whereIn('role_id', [2, 3])->get();
                break;

            case 'kelas':
                // target_ids adalah array kelas id
                $kelas = Kelas::whereIn('id', $ids)->get();
                foreach ($kelas as $k) {
                    // siswas() relasi many-to-many ke model Siswa, dan Siswa punya relasi user
                    foreach ($k->siswas as $siswa) {
                        if ($siswa->user) {
                            $users->push($siswa->user);
                        }
                    }
                }
                break;

            case 'guru':
                // target_ids adalah array guru id
                $gurus = Guru::whereIn('id', $ids)->get();
                foreach ($gurus as $g) {
                    if ($g->user) $users->push($g->user);
                }
                break;

            default:
                $users = collect();
        }

        return $users->unique('id')->values();
    }
}
