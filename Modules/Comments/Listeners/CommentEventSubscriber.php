<?php
namespace Modules\Comments\Listeners;

use Auth;

class CommentEventSubscriber
{
    protected $user;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::check() ? Auth::id() : 1;
    }

    /**
     * Comment created listener
     */
    public function onCommentCreated($event)
    {
        $event->comment->commentable->activities()->create(
            [
                'action' => 'activity_create_comment', 'icon'            => 'fa-comment-alt', 'user_id' => $this->user,
                'value1' => $event->comment->commentable->name, 'value2' => '',
                'url'    => $event->comment->commentable->url,
            ]
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Comments\Events\CommentCreated',
            'Modules\Comments\Listeners\CommentEventSubscriber@onCommentCreated'
        );
    }
}
