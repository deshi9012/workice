<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PurChecker;

class LicenseController extends Controller
{
    public $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function verify()
    {
        $this->request->validate(
            [
            'code' => 'required'
            ]
        );
        if ((new PurChecker())->exec()) {
            $data['message'] = 'Application validated';
            $data['redirect'] = '/';
            return ajaxResponse($data);
        }
        $data['errors'] = ['code' => ['Invalid! please try again']];
        return ajaxResponse($data, false, 500);
    }
}
