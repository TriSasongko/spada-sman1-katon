<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register your application's event listeners.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \App\Events\MateriCreated::class => [
            \App\Listeners\SendMateriNotificationToStudents::class,
        ],
        \App\Events\PengumumanCreated::class => [
            \App\Listeners\SendPengumumanNotifications::class,
        ],
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
