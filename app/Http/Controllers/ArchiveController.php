<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public $request;
    
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }
    public function archive()
    {
        if ($this->request->has('checked')) {
            \App\Jobs\Archiver::dispatch($this->request->checked, $this->request->module);
            $data['message']  = langapp('action_completed');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No '.$this->request->module.' selected', 'errors' => ['missing' => ["Please select atleast one item"]]], 500);
    }
}
