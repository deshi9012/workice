<?php

namespace Modules\Issues\Entities;

use App\Entities\Status;
use App\Traits\Actionable;
use App\Traits\BelongsToUser;
use App\Traits\Commentable;
use App\Traits\Observable;
use App\Traits\Taggable;
use App\Traits\Uploadable;
use App\Traits\Vaultable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Issues\Events\IssueCreated;
use Modules\Issues\Events\IssueDeleted;
use Modules\Issues\Events\IssueUpdated;
use Modules\Issues\Notifications\IssueCommented;
use Modules\Issues\Observers\IssueObserver;
use Modules\Projects\Entities\Project;
use Modules\Users\Entities\User;

class Issue extends Model
{
    use SoftDeletes, Actionable, Commentable, Taggable, Vaultable, Observable, Uploadable, BelongsToUser;

    protected $fillable = ['code', 'project_id', 'user_id', 'assignee', 'subject', 'reproducibility', 'severity', 'priority',
        'description', 'status', 'closed_at', 'meta'];

    protected static $observer = IssueObserver::class;
    protected static $scope    = null;

    /**
     * The event map for the model.
     *
     * @var array
     */

    protected $dispatchesEvents = [
        'created' => IssueCreated::class,
        'updated' => IssueUpdated::class,
        'deleted' => IssueDeleted::class,
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'assignee')->with('profile:user_id,avatar');
    }

    public function AsProject()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function AsStatus()
    {
        return $this->belongsTo(Status::class, 'status');
    }

    public function commentAlert($comment)
    {
        if ($this->assignee > 0) {
            return $this->agent->notify(new IssueCommented($this));
        } else {
            $members = $this->AsProject->assignees->filter(
                function ($member) {
                    return $member->user_id != \Auth::id();
                }
            );
            \Notification::send($members->pluck('user'), new IssueCommented($this));
        }
    }
    public function nextCode()
    {
        $code = sprintf('%04d', 1);
        $max  = $this->whereNotNull('code')->max('id');
        if ($max > 0) {
            $row         = $this->find($max);
            $ref_number  = intval(substr($row->code, -4));
            $next_number = $ref_number + 1;
            if ($next_number < 1) {
                $next_number = 1;
            }
            $next_number = $this->codeExists($next_number);
            $code        = sprintf('%04d', $next_number);
        }
        return get_option('issue_prefix') . $code;
    }
    public function codeExists($next_number)
    {
        $next_number = sprintf('%04d', $next_number);
        if ($this->withTrashed()->whereCode(get_option('issue_prefix') . $next_number)->count() > 0) {
            return $this->codeExists((int) $next_number + 1);
        }
        return $next_number;
    }
    public function getUrlAttribute()
    {
        return '/projects/view/' . $this->AsProject->id . '/issues/' . $this->id;
    }
}
