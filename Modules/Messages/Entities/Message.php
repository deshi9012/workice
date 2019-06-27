<?php

namespace Modules\Messages\Entities;

use App\Traits\Observable;
use App\Traits\Uploadable;
use Illuminate\Database\Eloquent\Model;
use Modules\Messages\Observers\MessageObserver;

class Message extends Model
{
    use Uploadable, Observable;

    protected static $observer = MessageObserver::class;
    protected static $scope    = null;

    public $timestamps = true;


    public $fillable = [
        'message',
        'is_seen',
        'deleted_from_sender',
        'deleted_from_receiver',
        'user_id',
        'conversation_id',
    ];

    /*
     * make dynamic attribute for human readable time
     *
     * @return string
     * */
    public function getHumansTimeAttribute()
    {
        $date = $this->created_at;
        $now = $date->now();

        return $date->diffForHumans($now, true);
    }

    /*
     * make a relation between conversation model
     *
     * @return collection
     * */
    public function conversation()
    {
        return $this->belongsTo('Modules\Messages\Entities\Conversation');
    }

    /*
    * make a relation between user model
    *
    * @return collection
    * */
    public function user()
    {
        return $this->belongsTo(config('talk.user.model', 'App\User'));
    }

    /*
    * its an alias of user relation
    *
    * @return collection
    * */
    public function sender()
    {
        return $this->user();
    }
}
