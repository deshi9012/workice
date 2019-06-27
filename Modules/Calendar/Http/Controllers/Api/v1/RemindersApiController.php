<?php

namespace Modules\Calendar\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Calendar\Http\Requests\ReminderRequest;
use Modules\Calendar\Notifications\ReminderAlert;

class RemindersApiController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function save(ReminderRequest $request)
    {
        $when = dateParser($request->reminder_date);
        $model = classByName($request->module)->findOrFail($request->module_id);
        $reminder = $model->reminders()->create($request->except(['module', 'module_id', 'url']));
        $reminder->recipient->notify((new ReminderAlert($reminder))->delay($when));
        $data['message'] = langapp('saved_successfully');
        $data['redirect'] = $request->url;

        return ajaxResponse($data, true, Response::HTTP_OK);
    }
}
