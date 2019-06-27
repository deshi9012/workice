<?php

namespace Modules\Messages\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Messages\Entities\Emailing;

class EmailOpened
{
    use SerializesModels;
    
    public $mail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Emailing $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
