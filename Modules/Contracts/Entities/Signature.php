<?php

namespace Modules\Contracts\Entities;

use App\Traits\BelongsToUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class Signature extends Model
{
    use BelongsToUser, SoftDeletes;

    protected $fillable = ['user_id', 'contract_id', 'ip_address', 'unix_time', 'device_agent', 'device_platform',
        'sign_identity', 'checksum', 'signature', 'image'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function getSignatureAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setSignatureAttribute($value)
    {
        $this->attributes['signature'] = Crypt::encryptString($value);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::check() ? \Auth::user()->id : $value;
    }

    public function setIpAddressAttribute($value)
    {
        $this->attributes['ip_address'] = request()->ip();
    }
    public function setUnixTimeAttribute($value)
    {
        $this->attributes['unix_time'] = Carbon::now()->timestamp;
    }
    public function setDeviceAgentAttribute($value)
    {
        $this->attributes['device_agent'] = request()->header('User-Agent');
    }

    public function setSignIdentityAttribute($value)
    {
        $this->attributes['sign_identity'] = '00' . genNumber() . 'C-T';
    }

    public function setChecksumAttribute($value)
    {
        $this->attributes['checksum'] = Hash::make(\Auth::check() ? \Auth::user()->email : $value);
    }
}
