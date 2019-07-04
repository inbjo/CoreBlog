<?php

namespace App\Listeners;

use App\Events\PostChange;
use Illuminate\Support\Facades\Cache;

class ClearPostCache
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
     * @param PostChange $event
     * @return void
     */
    public function handle(PostChange $event)
    {
        if ($event->action == 'update') {
            if (Cache::has('post:' . $event->post_id)) {
                Cache::forget('post:' . $event->post_id);
            }
        } else {
            Cache::tags('index-post')->flush();
            Cache::tags('category-post')->flush();
            Cache::tags('user-post')->flush();
            Cache::tags('tag-post')->flush();
        }
    }
}
