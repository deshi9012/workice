<?php

namespace Modules\Deals\Entities;

use App\Entities\Category;
use App\Traits\Actionable;
use App\Traits\BelongsToUser;
use App\Traits\Commentable;
use App\Traits\Customizable;
use App\Traits\Emailable;
use App\Traits\Eventable;
use App\Traits\Itemable;
use App\Traits\Noteable;
use App\Traits\Observable;
use App\Traits\Phoneable;
use App\Traits\Remindable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Todoable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Deals\Events\DealCreated;
use Modules\Deals\Events\DealDeleted;
use Modules\Deals\Jobs\CalculateDeal;
use Modules\Deals\Observers\DealObserver;
use Modules\Deals\Scopes\DealScope;
use Modules\Projects\Entities\Project;
use Modules\Projects\Jobs\ComputeProject;
use Modules\Tasks\Entities\Task;
use Modules\Users\Entities\User;

class Deal extends Model
{
    use Observable, SoftDeletes, Taggable, Actionable, Todoable, Commentable, Customizable,
    Noteable, Eventable, Uploadable, BelongsToUser, Searchable, Remindable, Phoneable, Emailable, Itemable;

    protected static $observer = DealObserver::class;
    protected static $scope    = DealScope::class;

    protected $fillable = [
        'title', 'stage_id', 'deal_value', 'contact_person', 'organization', 'due_date', 'status', 'won_time',
        'lost_time', 'lost_reason', 'source', 'pipeline', 'currency', 'computed_value', 'todo_percent', 'has_email', 'has_activity',
        'days_to_close', 'next_followup', 'user_id', 'archived_at',
    ];

    protected $dates = [
        'due_date', 'deleted_at', 'next_followup',
    ];
    protected $appends = [
        'propability', 'rotten', 'percent_done',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => DealCreated::class,
        'deleted' => DealDeleted::class,
    ];

    public function company()
    {
        return $this->belongsTo(Client::class, 'organization');
    }

    public function AsSource()
    {
        return $this->belongsTo(Category::class, 'source', 'id');
    }

    /**
     * Get lead category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'stage_id');
    }

    /**
     * Project attached to deal
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function contact()
    {
        return $this->belongsTo(User::class, 'contact_person', 'id')->with('profile:user_id,avatar');
    }

    /**
     * Get deal pipeline.
     */
    public function pipe()
    {
        return $this->belongsTo(Category::class, 'pipeline');
    }

    public function metaValue($key)
    {
        return optional($this->custom()->whereMetaKey($key)->first())->meta_value;
    }

    public function unreadMessages()
    {
        return $this->contact_person > 0 && !\App::runningUnitTests() ? $this->contact->emails()->unread()->count() : 0;
    }

    public function hasPendingActivity()
    {
        return $this->todos()->pending()->count();
    }

    public function doneTasks(): float
    {
        if (self::todos()->count() > 0) {
            return (float) (self::todos()->where('completed', 1)->count() / self::todos()->count()) * 100;
        }

        return 0.00;
    }

    public function isOpen()
    {
        self::notes()->create(
            [
                'description' => 'Deal has been opened by **' . \Auth::user()->name . '**',
                'user_id'     => \Auth::id(),
            ]
        );
    }

    public function nextActivities()
    {
        return $this->todos()->whereDate('due_date', '>', now()->toDateTimeString())
            ->whereAssigned(\Auth::id())->pending()
            ->orderBy('id', 'desc')
            ->get();
    }

    public function calActivities()
    {
        return $this->todos()->whereAssignee(\Auth::id())->orderBy('id', 'desc')->get();
    }

    public function commentAlert($comment)
    {
        \Notification::send($this->user, new \Modules\Deals\Notifications\DealCommented($this));
    }

    public function startComputeJob()
    {
        return CalculateDeal::dispatch($this)->onQueue('high');
    }

    public function ajaxTotals()
    {
        return [
            'deal_value' => formatCurrency($this->currency, $this->subTotal()),
            'scope'      => 'deals',
        ];
    }

    public function toProject()
    {
        $project                 = new Project;
        $project->code           = generateCode('projects');
        $project->name           = 'Project ' . $this->title;
        $project->description    = 'From ' . $this->AsSource->name . ' in pipeline ' . $this->pipe->name;
        $project->client_id      = $this->organization;
        $project->currency       = $this->currency;
        $project->start_date     = now()->toDateTimeString();
        $project->due_date       = now()->addDays(30);
        $project->billing_method = 'fixed_rate';
        $project->hourly_rate    = $this->user->profile->hourly_rate;
        $project->fixed_price    = $this->deal_value;
        $project->progress       = 0;
        $project->manager        = $this->user_id;
        $project->deal_id        = $this->id;
        $project->auto_progress  = 1;
        $project->notes          = 'Created from Deal ' . $this->title;
        $project->save();

        $project->assignees()->create(['user_id' => $this->user_id]);
        // Default project settings
        $default_settings = json_decode(get_option('default_project_settings'), true);
        foreach ($default_settings as $key => &$value) {
            if (strtolower($value) == 'off') {
                unset($default_settings[$key]);
            }
        }
        $project->update(['settings' => $default_settings]);

        foreach ($this->items as $key => $item) {
            $task                  = new Task();
            $task->name            = $item->name;
            $task->project_id      = $project->id;
            $task->description     = $item->description;
            $task->start_date      = now()->toDateTimeString();
            $task->due_date        = now()->addDays(30);
            $task->estimated_hours = 0.00;
            $task->hourly_rate     = $this->user->profile->hourly_rate;
            $task->user_id         = $this->user_id;
            $task->save();
            $task->assignees()->create(['user_id' => $this->user_id]);
        }

        foreach ($this->comments as $comment) {
            $project->comments()->create(
                [
                    'user_id' => $this->user_id,
                    'message' => $comment->message,
                ]
            );
        }

        foreach ($this->files as $file) {
            $file                  = $file->replicate();
            $file->uploadable_id   = $project->id;
            $file->uploadable_type = Project::class;
            $file->save();
        }

        $project->retag($this->tagList);

        ComputeProject::dispatch($project);

        $this->project_id = $project->id;
        $this->save();

        return $project;
    }

    public function compute()
    {
        $value = $this->items->count() ? $this->subTotal() : $this->deal_value;
        $this->update(
            [
                'deal_value'     => $value,
                'computed_value' => formatCurrency($this->currency, $value),
                'has_email'      => $this->unreadMessages() ? 1 : 0,
                'has_activity'   => $this->hasPendingActivity() ? 1 : 0,
            ]
        );
    }

    public function subTotal()
    {
        return $this->items->sum('total_cost');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = dbDate($value);
    }

    public function setDealValueAttribute($value)
    {
        $value                          = parseCurrency($value);
        $this->attributes['deal_value'] = $value > 0 ? $value : 0.00;
    }

    public function setLostTimeAttribute($value)
    {
        $this->attributes['lost_time'] = is_null($value) ? null : now()->toDateTimeString();
    }

    public function getRottenAttribute()
    {
        if ($this->status != 'open') {
            return false;
        }
        return $this->updated_at->diffInDays(now()) > get_option('deal_rotting') ? true : false;
    }
    public function getPercentDoneAttribute()
    {
        return $this->doneTasks();
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeWon($query)
    {
        return $query->where('status', 'won');
    }
    public function scopeLost($query)
    {
        return $query->where('status', 'lost');
    }

    public function getPropabilityAttribute()
    {
        $propability = 0;
        if ($this->status === 'won') {
            return 100;
        }
        if ($this->status === 'lost') {
            return 0;
        }
        $allStages = Category::wherePipeline($this->pipeline)->orderBy('order', 'asc')->get();
        foreach ($allStages as $stage) {
            $f = round(100 / $allStages->count());
            $propability += $f;
            if ($stage->id == $this->stage_id) {
                break;
            }
        }
        return $propability;
    }
    public function getNameAttribute()
    {
        return $this->title;
    }
    public function getUrlAttribute()
    {
        return '/deals/view/' . $this->id;
    }
}
