<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ThreadWasUpdated extends Notification
{
    protected $thread;

    protected $reply;

    public function __construct($thread, $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
    }

    public function via()
    {
        return ['database'];
    }

    public function toArray()
    {
        return [
            'message' => $this->reply->owner->name.trans('messages.threads_replied_to').$this->thread->title,
            'link'    => $this->reply->path(),
        ];
    }
}
