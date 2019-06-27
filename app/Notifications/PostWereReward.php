<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostWereReward extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'post_title' => $this->order->post->title,
            'user_name' => $this->order->payer->name,
            'user_avatar' => $this->order->payer->avatar,
            'pay_type' => $this->order->payment_method,
            'amount' => $this->order->total_amount,
            'remark' => $this->order->remark,
            'link' => route('post.show', $this->order->post->slug)
        ];
    }
}
