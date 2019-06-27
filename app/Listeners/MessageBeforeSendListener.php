<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Users\Entities\User;

class MessageBeforeSendListener
{
    public function handle(MessageSending $event)
    {
        if (isset($event->data['module'])) {
            $ent = classByName($event->data['module'])->where(['email' => key($event->message->getTo())])->first();
            return $ent->canReceiveEmail() ? $event : false;
        }
        return $event;
    }
}
