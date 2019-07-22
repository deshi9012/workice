<?php

namespace Modules\Users\Entities;

use App\Entities\Feedback;
use App\Entities\Phone;
use App\Entities\Reminder;
use App\Traits\Actionable;
use App\Traits\Emailable;
use App\Traits\Noteable;
use App\Traits\Observable;
use App\Traits\Searchable;
use App\Traits\Uploadable;
use App\Traits\Vaultable;
use Cache;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Activity\Entities\Activity;
use Modules\Calendar\Entities\Appointment;
use Modules\Calendar\Entities\Calendar;
use Modules\Comments\Entities\Comment;
use Modules\Contracts\Entities\Signature;
use Modules\Deals\Entities\Deal;
use Modules\Expenses\Entities\Expense;
use Modules\Files\Entities\FileUpload;
use Modules\Issues\Entities\Issue;
use Modules\Knowledgebase\Entities\Knowledgebase;
use Modules\Leads\Entities\Lead;
use Modules\Messages\Entities\Message;
use Modules\Projects\Entities\Link;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use Modules\Teams\Entities\Assignment;
use Modules\Tickets\Entities\Ticket;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Todos\Entities\Todo;
use Modules\Users\Entities\CannedResponse;
use Modules\Users\Entities\Profile;
use Modules\Users\Entities\QuickAccess;
use Modules\Users\Observers\UserObserver;
use Spatie\Permission\Traits\HasRoles;
use Auth;

class User extends Authenticatable implements HasLocalePreference, MustVerifyEmail
{
    use Notifiable, HasRoles, SoftDeletes, Searchable, Emailable,
    HasApiTokens, Vaultable, Observable, Actionable, Uploadable, Noteable;

    protected static $observer = UserObserver::class;
    protected static $scope    = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'email_verified_at', 'name', 'banned', 'ban_reason', 'last_ip', 'last_login', 'slack_webhook_url',
        'calendar_token', 'access_token', 'email_preferences', 'locale', 'unsubscribed_at', 'remember_token', 'google2fa_secret',
        'google2fa_enable', 'password', 'on_holiday','desk_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'calendar_token', 'googel2fa_secret',
    ];

    protected $dates = ['deleted_at'];
    protected $casts = [
        'email_preferences' => 'array',
        'access_token'      => 'string',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'desc');
    }

    public function feeds()
    {
        return $this->hasMany(Activity::class)->orderBy('id', 'desc');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'user_id');
    }
    public function articles()
    {
        return $this->hasMany(Knowledgebase::class, 'user_id');
    }
    public function uploads()
    {
        return $this->hasMany(FileUpload::class, 'user_id');
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function calls()
    {
        return $this->hasMany(Phone::class);
    }
    public function announcements()
    {
        return $this->hasMany(\App\Entities\Announcement::class, 'user_id')->orderBy('id', 'desc');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'user_id');
    }

    public function openDeals()
    {
        return Deal::whereOwner(\Auth::user()->id)->whereStatus('open')->orderBy('id', 'desc')->get();
    }

    /**
     * Get user messages.
     */
    public function inbox()
    {
        return \Modules\Messages\Facades\Talk::user(\Auth::id())->getInbox();
    }

    public function messages()
    {
        return Message::where('user_id', $this->id)->get();
    }

    // public function hasUnreadMessage()
    // {
    //     foreach ($this->messages() as $message) {
    //         if ($message->thread->is_seen == 0) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    /**
     * Get user tickets.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id')->with(['AsStatus', 'dept', 'AsPriority'])->orderBy('id', 'desc');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'user_id')->orderBy('id', 'desc');
    }

    public function timesheet()
    {
        return $this->hasMany(TimeEntry::class, 'user_id')->orderBy('id', 'desc');
    }
    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'recipient_id')->where('reminder_date', '>', now()->toDateTimeString())->with('recipient:id,name,email,username')->orderBy('id', 'desc');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'user_id')->with('category:id,name', 'pipe:id,name')->orderByDesc('id');
    }
    public function leads()
    {
        return $this->hasMany(Lead::class, 'sales_rep')->with('status:id,name', 'AsSource:id,name')->orderByDesc('id');
    }

    public function quickAccess()
    {
        return $this->hasMany(QuickAccess::class)->with('project:id,name,progress', 'task:id,name,progress,project_id');
    }

    public function todos()
    {
        return $this->hasMany(Todo::class, 'assignee')->where(
            function ($query) {
                $query->orWhere('parent', 0)->orWhereNull('parent');
            }
        )->orderBy('id', 'desc');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class)->where(
            function ($query) {
                $query->whereDate('start_time', '>=', today()->toDateString());
            }
        )->orWhere('attendee_id',Auth::user()->id)->orderByDesc('id');
    }

    public function schedules()
    {
        return $this->hasMany(Calendar::class)->orWhere(
            function ($query) {
                $query->where('user_id', \Auth::id())->orWhere('is_private', 0);
            }
        )->orderByDesc('id');
    }

    public function cannedResponses()
    {
        return $this->hasMany(CannedResponse::class)->latest();
    }
    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function todoToday()
    {
        return Cache::remember(
            'todo-today-count-' . \Auth::id(),
            15,
            function () {
                return $this->today()->pending()->count();
            }
        );
    }
    public function today()
    {
        return $this->todos()->whereDate('due_date', today());
    }
    public function tomorrow()
    {
        return $this->todos()->with('agent:id,username,name')->whereDate('due_date', today()->addDays(1));
    }
    public function thisWeek()
    {
        return $this->todos()->whereBetween('due_date', array(now()->startOfWeek(), now()->endOfWeek()));
    }

    // public function tasks()
    // {
    //     return $this->assignments()->where('task_id', '>', 0);
    // }

    // public function projects()
    // {
    //     return $this->assignments()->whereAssignableType(get_class(new Project));
    // }

    public function departments()
    {
        return $this->hasMany(UserHasDepartment::class);
    }

    public function undoneTasks()
    {
        return [];
        // return \Assignment::where('task_id', '>', 0)->
        // whereDate('due_date', '<', today()->toDateString())->orderBy('t_id', 'desc')->take(30)->get();
    }

    public function projectWorkedHours($id)
    {
        $hours = 0;
        foreach ($this->timesheet()->where('timeable_type', Project::class)->where('timeable_id', $id)->get() as $entry) {
            $hours += toHours($entry->worked);
        }
        return $hours;
    }

    public function signed()
    {
        return \Auth::user()->profile->signature ? true : false;
    }

    // get user favourited messages
    public function favourite()
    {
        $messages = $this->messages->where('deleted', 'No')->each(
            function ($item, $key) {
                if ($item->subject == null) {
                    $item->subject = 'No Subject';
                }
            }
        );

        return $messages->filter(
            function ($message) {
                return $message->favourite == 1;
            }
        );
    }

    public function important()
    {
        $messages = $this->messages->where('deleted', 'No')->each(
            function ($item, $key) {
                if ($item->subject == null) {
                    $item->subject = 'No Subject';
                }
            }
        );

        return $messages->filter(
            function ($message) {
                return $message->isImportant == 1;
            }
        );
    }

    public function ticketReplies($range = null)
    {
        if (is_null($range)) {
            return $this->comments()->where('commentable_type', Ticket::class)->count();
        }
        return $this->comments()->where('commentable_type', Ticket::class)->whereBetween('created_at', [$range[0], $range[1]])->count();
    }
    public function ticketResolved($range = null)
    {
        if (is_null($range)) {
            return Ticket::whereNotNull('closed_at')->whereAssignee($this->id)->count();
        }
        return Ticket::whereNotNull('closed_at')->whereAssignee($this->id)->whereBetween('created_at', [$range[0], $range[1]])->count();
    }
    public function ticketRating()
    {
        $ratings = Feedback::where('reviewable_type', Ticket::class)->whereAgentId($this->id)->count();
        $great   = Feedback::where('reviewable_type', Ticket::class)->whereAgentId($this->id)->where('satisfied', '1')->count();
        return $great > 0 ? ($great / $ratings) * 100 : 0;
    }

    public function setImpersonating($id)
    {
        \Session::put('impersonate', $id);
    }

    public function stopImpersonating()
    {
        \Session::forget('impersonate');
    }

    public function isImpersonating()
    {
        return \Session::has('impersonate');
    }

    public function scopeActive($query)
    {
        return $query->whereNotNull('email_verified_at')->whereBanned(0);
    }

    public function scopeOffHoliday($query)
    {
        return $query->where('on_holiday', 0);
    }

    public function getNameAttribute()
    {
        return empty($this->getOriginal('name')) ? $this->username : $this->getOriginal('name');
    }

    public function setPasswordAttribute($value)
    {
        if ($value != '') {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    public function notificationActive($notification)
    {
        if (empty($this->email_preferences)) {
            return true;
        }
        $enabled    = false;
        $collection = collect($this->email_preferences);
        foreach ($collection as $key => $item) {
            if ($key == $notification) {
                $enabled = isset($item['active']);
                break;
            }
        }
        return $enabled;
    }

    public function channelActive($channel, $notification)
    {
        if ($channel == 'nexmo' && config('services.nexmo.active') == false) {
            return false;
        }
        if (empty($this->email_preferences)) {
            return true;
        }
        $enabled    = false;
        $collection = collect($this->email_preferences);
        foreach ($collection as $key => $item) {
            if ($key == $notification && array_key_exists($channel, isset($item['via']) ? $item['via'] : [])) {
                $enabled = true;
            }
        }
        return $enabled;
    }

    public function canReceiveEmail($notification = null)
    {
        if (is_null($this->unsubscribed_at)) {
            return true;
        }
        if (is_null($notification)) {
            return true;
        }
        return array_key_exists($notification, (array) $this->email_preferences) ? false : true;
    }

    public function notifyOn($notification, $defaults = [])
    {
        if (empty($this->email_preferences)) {
            $ar = (array) $this->profile->channels;
            if (($key = array_search('broadcast', $ar)) !== false) {
                unset($ar[$key]);
            }
            return $ar;
        }
        if (array_key_exists($notification, (array) $this->email_preferences)) {
            return array_keys($this->email_preferences[$notification]['via']);
        }
        return $defaults;
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @return string
     */
    public function routeNotificationForSlack()
    {
        return $this->slack_webhook_url;
    }

    /**
     * Route notifications for the Nexmo channel.
     */
    public function routeNotificationForNexmo()
    {
        return $this->profile->mobile;
    }
    /**
     * Route notifications for the Slack channel.
     */
    public function preferredNotificationChannel()
    {
        return $this->profile->channels;
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'workice-user-' . $this->id;
    }

    public function preferredLocale()
    {
        return $this->locale;
    }

    public function sendEmailVerificationNotification()
    {
        if (config('system.verification')) {
            $this->notify(new \Modules\Users\Notifications\CustomVerifyEmail);
        }
        return;
    }

    /**
     * Ecrypt the user's google_2fa secret.
     *
     * @param  string $value
     * @return string
     */
    public function setGoogle2faSecretAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['google2fa_secret'] = encrypt($value);
        }
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string $value
     * @return string
     */
    public function getGoogle2faSecretAttribute($value)
    {
        if (!empty($value)) {
            return decrypt($value);
        }
    }

    public function getUrlAttribute()
    {
        return '/users/view/' . $this->id;
    }
}
