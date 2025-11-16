<?php

namespace App\Events;

use App\Models\Pengumuman;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PengumumanCreated
{
    use Dispatchable, SerializesModels;

    public $pengumuman;

    public function __construct(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }
}
