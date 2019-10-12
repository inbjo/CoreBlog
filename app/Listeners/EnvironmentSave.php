<?php

namespace App\Listeners;

use Flex\Installer\Events\EnvironmentSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class EnvironmentSave
{
    protected $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param EnvironmentSaved $event
     * @return void
     */
    public function handle(EnvironmentSaved $event)
    {
        $request = $event->getRequest();
        $admin = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        Cache::put('admin', $admin);
    }
}
