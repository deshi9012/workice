<?php

namespace Modules\Knowledgebase\Entities;

use App\Entities\Category;
use App\Traits\Actionable;
use App\Traits\BelongsToUser;
use App\Traits\Commentable;
use App\Traits\Observable;
use App\Traits\Reviewable;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Knowledgebase\Events\ArticleCreated;
use Modules\Knowledgebase\Events\ArticleDeleted;
use Modules\Knowledgebase\Events\ArticleUpdated;
use Modules\Knowledgebase\Notifications\ArticleCommented;
use Modules\Knowledgebase\Observers\KbObserver;
use Modules\Users\Entities\User;

class Knowledgebase extends Model
{
    use SoftDeletes, Commentable, Taggable, Observable, Actionable, BelongsToUser, Reviewable;

    protected static $observer = KbObserver::class;
    protected static $scope    = null;

    protected $fillable = ['group', 'subject', 'slug', 'description', 'user_id', 'order', 'active', 'views', 'allow_comments'];
    protected $table    = 'knowledgebase';

    /**
     * The relationships to eager load with the model count.
     *
     * @var array
     */
    protected $withCount = [
        'comments',
    ];

    protected $appends = ['rating'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'group');
    }

    public function commentAlert($comment)
    {
        if ($comment->user_id == $this->user_id) {
            \Notification::send($comment->user, new ArticleCommented($this));
        } else {
            $this->user->notify(new ArticleCommented($this));
        }
    }

    public function getRatingAttribute()
    {
        $great = $this->reviews()->whereSatisfied(1)->count();
        return $great > 0 ? ($great / $this->reviews()->count()) * 100 : 0;
    }

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id() ?? 1;
    }

    public function getNameAttribute()
    {
        return $this->subject;
    }
    public function getUrlAttribute()
    {
        return '/knowledgebase/view/' . $this->id;
    }
}
