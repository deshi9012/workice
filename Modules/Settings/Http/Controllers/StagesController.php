<?php

namespace Modules\Settings\Http\Controllers;

use App\Entities\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class StagesController extends Controller
{
    public $page;
    public $category;
    public $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(Category $category, Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request  = $request;
        $this->category = $category;
    }

    public function edit($id = null)
    {
        $data['stage'] = $this->category->findOrFail($id);

        return view('settings::modal.update_stage')->with($data);
    }

    public function update($id = null)
    {
        $stage = $this->category->findOrFail($id);
        $stage->update($this->request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function stages($module = null)
    {
        $data['stages'] = $this->category->whereModule($module)->orderBy('order', 'asc')->get();
        $data['module'] = $module;

        return view('settings::modal.stages')->with($data);
    }

    public function save()
    {
        if ($this->request->ajax()) {
            $this->request->validate(['name' => 'required']);
            if ($stage = $this->category->create($this->request->all())) {
                $stage->update(['order' => $this->category->whereModule($this->request->module)->count() + 1]);
                $html = view('settings::_ajax.new_stage_html', compact('stage'))->render();

                return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')], 200);
            }
        }
    }

    public function delete()
    {
        $id = $this->request->id;
        $stage = $this->category->findOrFail($id);
        if ($this->request->ajax()) {
            if ($stage->delete()) {
                \Modules\Leads\Entities\Lead::where('stage_id', $stage->id)->update(['stage_id' => get_option('default_' . str_singular($stage->module) . '_stage')]);
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
            }

            return response()->json(['status' => 'errors', 'message' => 'Something went wrong'], 401);
        }
    }

    public function order()
    {
        if ($this->request->ajax()) {
            foreach ($this->request->sortedList as $key => $item) {
                foreach ($item as $val) {
                    $id = str_replace('stage-', '', $val);
                    $this->category->findOrFail($id)->update(['order' => $key]);
                }
            }
            return response()->json(
                ['status' => 'success', 'message' => langapp('changes_saved_successful')],
                200
            );
        }
    }
}
