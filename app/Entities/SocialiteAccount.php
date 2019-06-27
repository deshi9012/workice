<?php

namespace App\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;

class SocialiteAccount extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    use BelongsToUser;
}
