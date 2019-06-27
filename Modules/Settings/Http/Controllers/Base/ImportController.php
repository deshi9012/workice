<?php

namespace Modules\Settings\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Updates\Jobs\ImportDataJob;
use Storage;

abstract class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', '2fa']);
    }

    public function import($type = null)
    {
        switch ($type) {
            case 'fo':
                return view('settings::modal.import_fo');
                break;

            default:
                // code...
                break;
        }
    }
    public function importJson(Request $request)
    {
        $request->validate(['jsondata' => 'required|file|mimes:json,txt']);
        $file = Storage::putFile('tmp', $request->jsondata);
        ImportDataJob::dispatch($request->jsondata->hashName(), \Auth::id());
        return ajaxResponse(
            [
                'message'  => 'We will notify you via email when the data has been imported',
                'redirect' => '/settings/info',
            ],
            true,
            Response::HTTP_OK
        );
    }
}
