<?php

namespace Modules\Expenses\Http\Controllers;

use App\Entities\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    protected $request;
    protected $category;
    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request, Category $category)
    {
        $this->middleware(['auth', 'can:settings']);
        $this->request  = $request;
        $this->category = $category;
    }

    public function showCategory()
    {
        $data['categories'] = $this->category->whereModule('expenses')->get();
        return view('expenses::_ajax.categories')->with($data);
    }

    public function saveCategory(CategoryRequest $request)
    {
        if ($request->ajax()) {
            if ($category = $this->category->create($request->all())) {
                $category->update(['order' => $this->category->whereModule('expenses')->count() + 1]);
                $html = view('expenses::_ajax.newCategoryHtml', compact('category'))->render();

                return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')], 200);
            }
        }
    }

    public function editCategory($id = null)
    {
        $data['category'] = $this->category->findOrFail($id);
        return view('expenses::modal.updateCategory')->with($data);
    }

    public function updateCategory(CategoryRequest $request, $id = null)
    {
        $category = $this->category->findOrFail($id);
        $category->update($request->only(['name', 'description']));
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function destroyCategory()
    {
        $id = $this->request->id;
        $category = $this->category->findOrFail($id);
        if ($this->request->ajax()) {
            if ($category->delete()) {
                \Modules\Knowledgebase\Entities\Knowledgebase::whereGroup($category->id)->update(['group' => 0]);
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
            }

            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], 401);
        }
    }
}
