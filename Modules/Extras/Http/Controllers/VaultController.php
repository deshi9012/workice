<?php

namespace Modules\Extras\Http\Controllers;

use App\Entities\Vault;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Extras\Http\Requests\VaultRequest;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('extras::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($module = null, $id = null)
    {
        $data['module'] = $module;
        $data['module_id']   = $id;
        return view('extras::vault.create')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id = null)
    {
        $data['vault'] = Vault::findOrFail($id);
        return view('extras::vault.update')->with($data);
    }

    /**
     * Show the resource to be deleted.
     *
     * @return \Illuminate\View\View
     */
    public function delete($id = null)
    {
        $data['id'] = $id;
        return view('extras::vault.delete')->with($data);
    }
}
