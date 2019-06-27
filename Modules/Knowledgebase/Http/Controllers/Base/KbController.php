<?php

namespace Modules\Knowledgebase\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Knowledgebase\Entities\Knowledgebase;
use Modules\Knowledgebase\Http\Requests\ArticleRequest;

abstract class KbController extends Controller
{
    /**
     * Knowledgebase model
     *
     * @var \Modules\Knowledgebase\Entities\Knowledgebase
     */
    protected $kb;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_knowledgebase']);
        $this->request = $request;
        $this->kb      = new Knowledgebase;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = $this->getPage();

        return view('knowledgebase::index')->with($data);
    }
    /**
     * View Article
     */
    public function view(Knowledgebase $kb)
    {
        $data['page']    = $this->getPage();
        $data['article'] = $kb;

        event(new \Modules\Knowledgebase\Events\ArticleViewed($kb));

        return view('knowledgebase::view')->with($data);
    }
    /**
     * Show create article form
     */
    public function create()
    {
        $data['page'] = $this->getPage();

        return view('knowledgebase::create')->with($data);
    }
    /**
     * Update article form
     */
    public function edit(Knowledgebase $kb)
    {
        $data['page']    = $this->getPage();
        $data['article'] = $kb;

        return view('knowledgebase::update')->with($data);
    }
    /**
     * Update knowledgabse article
     */
    public function update(ArticleRequest $request, Knowledgebase $kb)
    {
        $this->authorize('update', $kb);
        $kb->update($request->except('id'));

        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('kb.view', ['id' => $kb->id]);

        return ajaxResponse($data);
    }
    /**
     * Save article
     */
    public function save(ArticleRequest $request)
    {
        $kb = $this->kb->create($request->all());
        $kb->unsetEventDispatcher();
        $kb->update(['order' => $this->kb->max('order') + 1]);
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('kb.view', ['id' => $kb->id]);

        return ajaxResponse($data);
    }
    /**
     * Vote article
     */
    public function vote(Knowledgebase $article, $vote = null)
    {
        $article->reviews()->updateOrCreate(
            [
                'user_id' => \Auth::id(),
            ],
            [
                'satisfied' => $vote, 'agent_id' => $article->user_id,
            ]
        );

        toastr()->success(langapp('action_completed'), langapp('response_status'));

        return redirect()->route('kb.view', ['kb' => $article->id]);
    }
    /**
     * Confirm delete article modal
     */
    public function delete(Knowledgebase $kb)
    {
        $data['article'] = $kb;

        return view('knowledgebase::delete')->with($data);
    }
    /**
     * Delete article
     */
    public function destroy(Knowledgebase $kb)
    {
        $this->authorize('delete', $kb);
        $kb->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect()->route('kb.index');
    }

    private function getPage()
    {
        return langapp('knowledgebase');
    }
}
