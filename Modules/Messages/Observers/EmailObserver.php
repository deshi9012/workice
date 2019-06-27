<?php

namespace Modules\Messages\Observers;

use Modules\Messages\Entities\Emailing;

class EmailObserver
{

    /**
     * Listen to the email deleted event.
     *
     * @param Emailing $mail
     */
    public function deleting(Emailing $mail)
    {
        $mail->replies()->each(
            function ($reply) {
                $reply->delete();
            }
        );
        $mail->files->each(
            function ($file) {
                $file->delete();
            }
        );
    }
}
