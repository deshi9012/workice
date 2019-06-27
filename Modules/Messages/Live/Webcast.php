<?php

namespace Modules\Messages\Live;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Messages\Notifications\MessageReceived;
use Modules\Users\Entities\User;

class Webcast implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /*
    * Message Model Instance
    *
    * @var object
    * */
    protected $message;

    /*
     * Broadcast class instance
     *
     * @var object
     * */
    protected $broadcast;

    /**
     * Set message collections to the properties.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /*
     * Execute the job and broadcast to the pusher channels
     *
     * @param \Modules\Messages\Live\Broadcast $broadcast
     * @return void
     */
    public function handle(Broadcast $broadcast)
    {
        $this->broadcast = $broadcast;
        $toUser = ($this->message['sender']['id'] == $this->message['conversation']['user_one']) ? $this->message['conversation']['user_two'] : $this->message['conversation']['user_one'];

        $channelForUser = 'private-workice-user-'.$toUser;
        $data = [
            'id' => $this->message['id'],
            'chat' => $this->message['message'],
            'conversation_id' => $this->message['conversation_id'],
            'user_id' => $this->message['user_id'],
            'sender' => $this->message['sender']['email'],
            'sender_name' => $this->message['sender']['name'],
            'message' => 'You have received a new message.'
        ];
        \Notification::send(User::find($toUser), new MessageReceived($data));
        $this->broadcast->pusher->trigger($channelForUser, 'workice.event', $data);
    }
}
