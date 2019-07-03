<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class PostChange
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post_id, $action;

    /**
     * Create a new event instance.
     *
     * @param $post_id
     * @param $action
     */
    public function __construct($post_id, $action)
    {
        $this->post_id = $post_id;
        $this->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
