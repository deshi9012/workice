<?php

namespace Modules\Messages\Observers;

use Modules\Messages\Entities\Message;

class MessageObserver
{

    /**
     * Listen to the message deleted event.
     *
     * @param Message $message
     */
    public function deleted(Message $message)
    {
        $message->files->each(
            function ($file) {
                \Storage::disk($file->adapter)->delete($file->path.'/'.$file->filename);
                $file->delete();
            }
        );
    }
}
