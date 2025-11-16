<?php

namespace App\Events;

use App\Models\Materi;
use Illuminate\Foundation\Events\Dispatchable;

class MateriCreated
{
    use Dispatchable;

    public $materi;

    public function __construct(Materi $materi)
    {
        $this->materi = $materi;
    }
}
