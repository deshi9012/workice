<?php

namespace Modules\Messages\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Messages\Notifications\EmailOpenedAlert;

class EmailEventSubscriber implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Email viewed listener
     */
    public function onEmailViewed($event)
    {
        if ($event->mail->opened == 0) {
            if ($event->mail->from) {
                $event->mail->sender->notify(new EmailOpenedAlert($event->mail));
                $event->mail->update(['opened' => 1]);
            }
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Modules\Messages\Events\EmailOpened',
            'Modules\Messages\Listeners\EmailEventSubscriber@onEmailViewed'
        );
    }
}
