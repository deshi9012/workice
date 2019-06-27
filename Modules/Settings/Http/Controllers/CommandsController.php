<?php

namespace Modules\Settings\Http\Controllers;

use Artisan;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CommandsController extends Controller
{
    public function run($key, $command = null)
    {
        if ($key != get_option('cron_key')) {
            return abort(401);
        }
        $command = str_replace("-", ":", $command);
        Artisan::queue($command)->onQueue('high');
        return ajaxResponse(
            [
                'message'  => 'Command executed successfully',
                'redirect' => url()->previous(),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function regenerateKey()
    {
        update_option('cron_key', str_random(60));
        \Artisan::call('app:flush');
        toastr()->success('Artisan command key regenerated', langapp('response_status'));

        return redirect(url()->previous());
    }
}
