<?php

namespace Modules\Deals\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Deals\Entities\Deal;
use Modules\Deals\Events\DealLost;
use Modules\Deals\Events\DealUpdated;
use Modules\Deals\Events\DealWon;
use Modules\Deals\Http\Requests\DealRequest;
use Modules\Deals\Jobs\DealToProject;
use Modules\Deals\Transformers\DealResource;
use Modules\Deals\Transformers\DealsResource;
use Modules\Extras\Transformers\CallsResource;
use Modules\Items\Transformers\ItemsResource;
use Modules\Todos\Transformers\TodosResource;

class DealsApiController extends Controller
{
    protected $request;
    protected $deal;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->deal    = new Deal;
    }

    public function index()
    {
        $deals = new DealsResource(
            $this->deal->whereNull('archived_at')->open()
                ->with(['company:id,name,email', 'contact:id,email', 'category:id,name', 'AsSource:id,name', 'pipe:id,name'])
                ->orderByDesc('id')
                ->paginate(50)
        );
        return response($deals, Response::HTTP_OK);
    }

    public function show($id = null)
    {
        $deal = $this->deal->findOrFail($id);
        return response(new DealResource($deal), Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function calls($id = null)
    {
        $deal  = $this->deal->findOrFail($id);
        $calls = new CallsResource($deal->calls()->orderBy('id', 'desc')->paginate(50));
        return response($calls, Response::HTTP_OK);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function todos($id = null)
    {
        $deal  = $this->deal->findOrFail($id);
        $todos = new TodosResource($deal->todos()->with(['agent:id,username,name'])->orderBy('id', 'desc')->paginate(50));
        return response($todos, Response::HTTP_OK);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function comments($id = null)
    {
        $deal     = $this->deal->findOrFail($id);
        $comments = new CommentsResource($deal->comments()->orderBy('id', 'desc')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function products($id = null)
    {
        $deal  = $this->deal->findOrFail($id);
        $items = new ItemsResource($deal->items()->orderBy('id', 'desc')->paginate(50));
        return response($items, Response::HTTP_OK);
    }

    public function save(DealRequest $request)
    {
        $deal = $this->deal->create($request->except(['custom', 'tags']));

        if ($request->has('line_items')) {
            foreach ($request->line_items as $item) {
                $deal->items()->create($item);
            }
        }

        return ajaxResponse(
            [
                'id'       => $deal->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('deals.view', $deal->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }

    public function update(DealRequest $request, $id = null)
    {
        $deal = $this->deal->findOrFail($id);
        $deal->update($request->except(['custom', 'tags']));
        event(new DealUpdated($deal));

        return ajaxResponse(
            [
                'id'       => $deal->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('deals.view', $deal->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    // Deal is won 🎉
    public function won($id)
    {
        $deal = $this->deal->findOrFail($id);
        if ($this->request->has('convert_project')) {
            DealToProject::dispatch($deal);
        }
        event(new DealWon($deal));
        return ajaxResponse(
            [
                'id'       => $deal->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('deals.view', $deal->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function close($id)
    {
        $deal = $this->deal->findOrFail($id);
        event(new DealLost($deal));
        return ajaxResponse(
            [
                'id'       => $deal->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('deals.view', $deal->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function delete($id = null)
    {
        $deal = $this->deal->findOrFail($id);
        $deal->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('deals.view', $deal->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
