<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //优化配置
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('optimize');
        //todo 同步索引

        //创建软连接
        Artisan::call('storage:link');
    }
}
