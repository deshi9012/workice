<?php

namespace Modules\Comments\Observers;

use Modules\Comments\Entities\Comment;
use Modules\Tickets\Entities\Ticket;

class CommentObserver
{
    /**
     * Listen to the Comment creating event.
     *
     * @param Comment $comment
     */
    public function creating(Comment $comment)
    {
        $comment->is_note = $this->isNoteComment($comment->message) ? 1 : 0;
        $comment->user_id = \Auth::id() ?? $comment->user_id;
    }

    /**
     * Listen to the Comment created event.
     *
     * @param Comment $comment
     */
    public function created(Comment $comment)
    {
        if ($comment->commentable_type == get_class(new Ticket)) {
            if ($comment->commentable->is_locked) {
                if ($comment->commentable->locked_by == \Auth::id()) {
                    $comment->commentable->update(['is_locked' => 0, 'locked_by' => 0, 'assignee' => \Auth::id()]);
                }
            }
            if (!is_null($comment->commentable->closed_at)) {
                $comment->commentable->openTicket();
            }
        }
        $comment->notify();
    }

    /**
     * Listen to Comment deleting event.
     *
     * @param Comment $comment
     */
    public function deleting(Comment $comment)
    {
        $comment->files->each(
            function ($file) {
                $file->delete();
            }
        );

        $comment->replies()->each(
            function ($reply) {
                $reply->delete();
            }
        );
    }

    protected function isNoteComment($text)
    {
        if (strpos($text, '[NOTE]') !== false) {
            return true;
        }

        return false;
    }
}
