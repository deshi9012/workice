<?php

namespace Modules\Settings\Http\Controllers;

use App\Entities\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class PipelinesController extends Controller
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

    public function pipelines()
    {
        $data['pipelines'] = $this->category->whereModule('pipeline')->orderBy('order', 'asc')->get();

        return view('settings::modal.pipelines')->with($data);
    }

    public function save()
    {
        if ($this->request->ajax()) {
            $this->request->validate(['name' => 'required']);
            if ($pipeline = $this->category->create($this->request->all())) {
                $pipeline->update(['order' => $this->category->whereModule('pipeline')->count() + 1]);
                $html = view('settings::_ajax.new_pipeline_html', compact('pipeline'))->render();

                return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')], 200);
            }
        }
    }

    public function edit($id = null)
    {
        $data['pipeline'] = $this->category->findOrFail($id);

        return view('settings::modal.update_pipeline')->with($data);
    }

    public function update($id = null)
    {
        $pipeline = $this->category->findOrFail($id);
        $pipeline->update($this->request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function delete()
    {
        $id = $this->request->id;
        $pipeline = $this->category->findOrFail($id);
        if ($this->request->ajax()) {
            if ($pipeline->delete()) {
                \Modules\Deals\Entities\Deal::wherePipeline($pipeline->id)->update(['pipeline' => get_option('default_deal_pipeline'), 'stage_id' => get_option('default_deal_stage')]);
                return response()->json(
                    [
                        'status' => 'success', 'message' => langapp('deleted_successfully')],
                    200
                );
            }

            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], 401);
        }
    }

    public function order()
    {
        if ($this->request->ajax()) {
            foreach ($this->request->sortedList as $key => $item) {
                foreach ($item as $val) {
                    $id = str_replace('pipeline-', '', $val);
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
