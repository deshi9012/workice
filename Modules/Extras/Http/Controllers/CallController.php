<?php

namespace Modules\Extras\Http\Controllers;

use App\Entities\Phone;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CallController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Phone model
     *
     * @var \App\Entities\Phone
     */
    protected $phone;

    public function __construct(Request $request, Phone $phone)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
        $this->phone   = $phone;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($module = null, $id = null)
    {
        $data['module'] = $module;
        $data['id']     = $id;
        return view('extras::modal.create_call')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Phone $call)
    {
        $data['call'] = $call;
        return view('extras::modal.update')->with($data);
    }
}
