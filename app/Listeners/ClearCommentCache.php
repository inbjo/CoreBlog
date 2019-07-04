<?php

namespace App\Listeners;

use App\Events\CommentChange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class ClearCommentCache
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
     * @param CommentChange $event
     * @return void
     */
    public function handle(CommentChange $event)
    {
        if (Cache::has('post:' . $event->comment->post_id)) {
            Cache::forget('post:' . $event->comment->post_id);
        }
    }
}
