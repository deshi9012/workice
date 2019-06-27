<?php

namespace Modules\Comments\Entities;

use App\Traits\BelongsToUser;
use App\Traits\Observable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Comments\Entities\Comment;
use Modules\Comments\Events\CommentCreated;
use Modules\Comments\Observers\CommentObserver;

class Comment extends Model
{
    use SoftDeletes, Observable, Uploadable, BelongsToUser;

    protected static $observer = CommentObserver::class;
    protected static $scope    = null;

    protected $fillable = [
        'parent', 'user_id', 'message', 'unread', 'is_note', 'commentable_id', 'commentable_type', 'created_at',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CommentCreated::class,
    ];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent')->orderBy('id', 'desc');
    }

    public function markRead()
    {
        if ($this->user_id != \Auth::id()) {
            return $this->update(['unread' => 0]);
        }
    }

    public function notify()
    {
        $this->commentable->commentAlert($this);
    }

    public function isVisible()
    {
        if ($this->is_note === 1) {
            return \Auth::id() == $this->user_id || $this->commentable->isAgent();
        }
        return true;
    }

    public function scopeUnread($query)
    {
        return $query->whereUnread(1);
    }

    public function getMessageAttribute($value)
    {
        return $value;
        // return EmojiOne::toImage($value);
    }
}
