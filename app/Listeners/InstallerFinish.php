<?php

namespace App\Listeners;

use App\Models\User;
use Flex\Installer\Events\LaravelInstallerFinished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class InstallerFinish
{
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
     * @param LaravelInstallerFinished $event
     * @return void
     */
    public function handle(LaravelInstallerFinished $event)
    {
        $admin = Cache::pull('admin');
        if ($admin) {
            User::updateOrCreate(
                ['id' => 1],
                [
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'avatar' => generateAvatar($admin['email']),
                    'password' => bcrypt($admin['password']),
                    'bio' => '这家伙很懒什么也没写~',
                    'email_verified_at' => Carbon::now()->toDateTimeString(),
                ]
            );
        }
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('optimize');
        Artisan::call('storage:link');
    }
}
