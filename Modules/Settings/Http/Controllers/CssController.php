<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CssController extends Controller
{
    public function customize(Request $request)
    {
        \Storage::disk('local')->put('public/css/style.css', $request->custom_css);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));
        return redirect(url()->previous());
    }
}
