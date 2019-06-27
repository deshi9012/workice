<?php

namespace Modules\Users\Entities;

use App\Traits\BelongsToUser;
use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Clients\Entities\Client;
use Modules\Users\Observers\ProfileObserver;

class Profile extends Model
{
    use BelongsToUser, Observable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company', 'job_title', 'city', 'country', 'address', 'phone', 'mobile', 'skype',
        'avatar', 'use_gravatar', 'hourly_rate', 'state', 'zip_code', 'website', 'twitter', 'signature',
        'email_signature', 'channels',
    ];
    protected $casts = [
        'channels' => 'array',
    ];
    protected $appends = ['sign'];

    protected static $observer = ProfileObserver::class;
    protected static $scope    = null;

    public function business()
    {
        return $this->belongsTo(Client::class, 'company');
    }

    public function scopeContacts($query)
    {
        return $query->where('company', '>', 0);
    }

    public function scopeSearchEmail($query, $search)
    {
        return $query->orWhereHas(
            'user',
            function ($q) use ($search) {
                $q->where('email', 'LIKE', "%$search%");
            }
        );
    }
    public function scopeSearchName($query, $search)
    {
        return $query->orWhereHas(
            'user',
            function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            }
        );
    }

    public function scopeSearchUsername($query, $search)
    {
        return $query->orWhereHas(
            'user',
            function ($q) use ($search) {
                $q->where('username', 'LIKE', "%$search%");
            }
        );
    }

    public function getPhotoAttribute()
    {
        return is_null($this->avatar) ? $this->createAvatar() : $this->getAvatar();
    }

    protected function createAvatar()
    {
        $this->update(['avatar' => \Avatar::create($this->user->email)->toGravatar()]);
        return $this->getAvatar();
    }

    public function getAvatar()
    {
        if ($this->use_gravatar == 1 && settingEnabled('use_gravatar')) {
            return app('gravatar')->get($this->user->email);
        }
        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        return \Storage::url(config('system.avatar_dir') . '/' . $this->avatar);
    }

    public function getSignAttribute()
    {
        return \Storage::url(config('system.signature_dir') . '/' . $this->signature);
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }
}
