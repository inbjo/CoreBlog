<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentWereMentioned extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @param $comment
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->comment->user->name . ' 在评论中提及您')
            ->line("{$this->comment->user->name}在文章: {$this->comment->post->title}的评论中提及了您")
            ->action('点击查看', route('post.show', $this->comment->post->slug) . '#comment' . $this->comment->id)
            ->line('内容如下：')
            ->line(strip_tags($this->comment->content));
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
            'user_id' => $this->comment->user->id,
            'user_name' => $this->comment->user->name,
            'user_avatar' => $this->comment->user->avatar,
            'post_id' => $this->comment->post->id,
            'post_title' => $this->comment->post->title,
            'comment_content' => $this->comment->content,
            'link' => route('post.show', $this->comment->post->slug) . '#comment' . $this->comment->id
        ];
    }
}
