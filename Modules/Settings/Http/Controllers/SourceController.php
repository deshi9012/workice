<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SourceController extends Controller
{
    public $page;
    public $category;
    public $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(\App\Entities\Category $category, Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request  = $request;
        $this->category = $category;
    }

    public function sources($module = null)
    {
        $data['sources'] = $this->category->whereModule('source')->orderBy('order', 'asc')->get();

        return view('settings::modal.sources')->with($data);
    }

    public function save()
    {
        if ($this->request->ajax()) {
            $this->request->validate(['name' => 'required']);
            if ($source = $this->category->create($this->request->all())) {
                $source->update(['order' => $this->category->whereModule('source')->count() + 1]);
                $html = view('settings::_ajax.new_source_html', compact('source'))->render();

                return response()->json(
                    [
                        'status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')],
                    200
                );
            }
        }
    }

    public function edit($id = null)
    {
        $data['source'] = $this->category->findOrFail($id);

        return view('settings::modal.update_source')->with($data);
    }

    public function update($id = null)
    {
        $source = $this->category->findOrFail($id);
        $source->update($this->request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function delete()
    {
        $id = $this->request->id;
        $source = $this->category->findOrFail($id);
        if ($this->request->ajax()) {
            if ($source->delete()) {
                return response()->json(
                    [
                        'status' => 'success', 'message' => langapp('deleted_successfully')],
                    200
                );
            }

            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], 401);
        }
    }
}
