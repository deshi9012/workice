<?php

namespace Modules\Messages\Entities;

use App\Traits\Observable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Messages\Observers\EmailObserver;
use Modules\Users\Entities\User;

class Emailing extends Model
{
    use SoftDeletes, Observable, Uploadable;

    protected static $observer = EmailObserver::class;
    protected static $scope    = null;

    protected $table    = 'emails';
    protected $fillable = [
        'to', 'from', 'subject', 'message', 'mail_folder', 'meta', 'reply_id', 'read', 'is_draft', 'opened', 'reserved_at',
        'emailable_type', 'emailable_id',
    ];
    protected $casts = [
        'meta' => 'array',
    ];

    public function emailable()
    {
        return $this->morphTo();
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function replies()
    {
        return $this->where('reply_id', $this->id)->orderBy('id', 'asc')->get();
    }

    public function markRead()
    {
        $this->update(['read' => 1]);
        $this->emailable->compute();
    }

    public function search($keyword)
    {
        return \Auth::user()->emails()->where('message', 'LIKE', '%' . $keyword . '%');
    }

    public function setFromAttribute($value)
    {
        $this->attributes['from'] = is_null($value) ? \Auth::id() : $value;
    }

    public function scopeUnread($query)
    {
        return $query->whereRead(0);
    }

    public function scopeRead($query)
    {
        return $query->whereRead(1);
    }
}
