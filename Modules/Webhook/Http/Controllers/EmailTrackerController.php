<?php

namespace Modules\Webhook\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Messages\Entities\Emailing;
use Modules\Messages\Events\EmailOpened;

class EmailTrackerController extends Controller
{
    public function track(Emailing $mail)
    {
        event(new EmailOpened($mail));
        return response(file_get_contents(storage_path('app/public/media/pixel.gif')))
            ->header('content-type', 'image/gif');
    }
}
