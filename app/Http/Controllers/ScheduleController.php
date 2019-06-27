<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class ScheduleController extends Controller
{
    public function run($token)
    {
        if ($token == get_option('cron_key')) {
            Artisan::call('schedule:run');
            return response()->json(['status' => 'success', 'message' => 'Processed successfully'], 200);
        }
        return response()->json(['status' => 'failed', 'message' => 'Failed to process check CRON Key'], 500);
    }
}
