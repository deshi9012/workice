<?php

namespace App\Entities;

use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Users\Observers\VaultObserver;
use Modules\Users\Scopes\VaultScope;

class Vault extends Model
{
    use Observable, SoftDeletes;

    protected static $observer = VaultObserver::class;
    protected static $scope    = VaultScope::class;

    protected $fillable = [
        'key',
        'value',
        'vaultable_id',
        'vaultable_type',
        'user_id',
    ];
    protected $appends = ['key_value'];

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id();
    }
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = encrypt($value);
    }
    public function getKeyValueAttribute()
    {
        return decrypt($this->value);
    }
}
