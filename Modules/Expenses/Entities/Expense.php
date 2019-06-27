<?php

namespace Modules\Expenses\Entities;

use App\Entities\Category;
use App\Traits\Actionable;
use App\Traits\BelongsToUser;
use App\Traits\Commentable;
use App\Traits\Customizable;
use App\Traits\Eventable;
use App\Traits\Observable;
use App\Traits\Recurrable;
use App\Traits\Remindable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Todoable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Expenses\Events\ExpenseCreated;
use Modules\Expenses\Events\ExpenseDeleted;
use Modules\Expenses\Events\ExpenseUpdated;
use Modules\Expenses\Notifications\ExpenseCommented;
use Modules\Expenses\Observers\ExpenseObserver;
use Modules\Expenses\Scopes\ExpenseScope;
use Modules\Expenses\Services\ExpenseCalculator;
use Modules\Invoices\Entities\Invoice;
use Modules\Projects\Entities\Project;
use Modules\Users\Entities\User;

class Expense extends Model
{
    use SoftDeletes, BelongsToUser, Taggable, Commentable, Observable, Actionable, Uploadable,
    Eventable, Remindable, Searchable, Todoable, Recurrable, Customizable;

    protected static $observer = ExpenseObserver::class;
    protected static $scope    = ExpenseScope::class;

    protected $fillable = [
        'code', 'billable', 'amount', 'amount_formatted', 'expense_date', 'notes',
        'project_id', 'client_id', 'invoiced', 'invoiced_id', 'category', 'tax', 'tax2', 'todo_percent', 'currency',
        'is_recurring', 'exchange_rate', 'vendor', 'is_visible', 'user_id', 'archived_at', 'before_tax', 'taxed',
    ];
    protected $dates = [
        'expense_date',
    ];

    protected $appends = ['cost'];

    protected $casts = [
        'is_recurring' => 'integer',
        'is_visible'   => 'integer',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ExpenseCreated::class,
        'updated' => ExpenseUpdated::class,
        'deleted' => ExpenseDeleted::class,
    ];

    public function AsProject()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function company()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function AsCategory()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function AsInvoice()
    {
        return $this->belongsTo(Invoice::class, 'invoiced_id');
    }

    public function metaValue($key)
    {
        return optional($this->custom()->whereMetaKey($key)->first())->meta_value;
    }

    public function recur()
    {
        $recurDays = request('recurring.frequency');
        $nextDate  = nextRecurringDate(today(), $recurDays);
        $this->update(['is_recurring' => 1]);
        return $this->recurring()->updateOrCreate(
            ['recurrable_id' => $this->id],
            [
                'next_recur_date' => $nextDate,
                'recur_starts'    => dbDate(request('recurring.recur_starts')),
                'recur_ends'      => dbDate(request('recurring.recur_ends')),
                'frequency'       => $recurDays,
            ]
        );
    }

    public function recurred()
    {
        $this->update(
            [
                'code'         => 'R-' . $this->code,
                'is_recurring' => 0,
                'invoiced'     => 0,
                'invoiced_id'  => null,
                'expense_date' => now()->toDateTimeString(),
            ]
        );
    }

    public function stopRecurring()
    {
        if ($this->is_recurring === 1) {
            $this->update(['is_recurring' => 0]);
            return $this->recurring->delete();
        }
    }

    public function commentAlert($comment)
    {
        $user = User::role('admin')->first();
        if ($user->id != $comment->user_id) {
            \Notification::send($user, new ExpenseCommented($this));
        }
    }

    public function tax1Amount()
    {
        return formatDecimal(($this->tax / 100) * $this->amount, get_option('tax_decimals'));
    }
    public function tax2Amount()
    {
        return formatDecimal(($this->tax2 / 100) * $this->amount, get_option('tax_decimals'));
    }
    public function totalTax()
    {
        return $this->tax1Amount() + $this->tax2Amount();
    }

    public function compute()
    {
        return $this->update(
            [
                'before_tax' => (new ExpenseCalculator($this))->beforeTax(),
                'taxed'      => (new ExpenseCalculator($this))->taxed(),
            ]
        );
    }

    /**
     * Sets filter to only recurring expenses which should be generated now.
     */
    // public function recurring()
    // {
    //     $isActive = self::whereDate('recur_ends', '>', today()->toDateString())
    //         ->where('is_recurring', 1)
    //         ->whereDate('recur_starts', '<=', today()->toDateString())
    //         ->get();

    //     $filtered = $isActive->filter(function ($value, $key) {
    //         return strtotime($value->next_recur_date) <= time();
    //     });

    //     return $filtered->all();
    // }

    public function nextCode()
    {
        $code = sprintf('%04d', get_option('expense_start_no'));
        $max  = $this->max('id');
        if ($max > 0) {
            $row         = $this->find($max);
            $code        = intval(substr($row->code, -4));
            $next_number = $code + 1;
            if ($next_number < get_option('expense_start_no')) {
                $next_number = get_option('expense_start_no');
            }
            $next_number = $this->codeExists($next_number);

            $code = sprintf('%04d', $next_number);
        }
        return get_option('expense_prefix') . $code;
    }

    public function codeExists($next_number)
    {
        $next_number = sprintf('%04d', $next_number);
        if ($this->withTrashed()->where('code', get_option('expense_prefix') . $next_number)->count() > 0) {
            return $this->codeExists((int) $next_number + 1);
        } else {
            return $next_number;
        }
    }

    public function statusIcon()
    {
        if ($this->invoiced === 1) {
            return '<span class="text-success">✔</span> ';
        }
        if ($this->billable === 0) {
            return '<span class="text-danger">✘</span> ';
        }
        if ($this->is_recurring === 1) {
            return '<i class="fas fa-sync-alt text-info fa-spin"></i> ';
        }

        return '<i class="fas fa-exclamation-circle text-warning"></i> ';
    }

    public function getCostAttribute()
    {
        return $this->before_tax;
    }

    public function setExpenseDateAttribute($value)
    {
        $this->attributes['expense_date'] = dbDate($value);
    }

    public function scopeBillable($query)
    {
        return $query->where('billable', 1);
    }
    public function scopeUnbillable($query)
    {
        return $query->where('billable', 0);
    }
    public function scopeBilled($query)
    {
        return $query->where('invoiced', 1);
    }
    public function scopeUnbilled($query)
    {
        return $query->where('invoiced', 0);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id() ?? 1;
    }
    public function getNameAttribute()
    {
        return $this->code;
    }
    public function getUrlAttribute()
    {
        return '/expenses/view/' . $this->id;
    }
}
