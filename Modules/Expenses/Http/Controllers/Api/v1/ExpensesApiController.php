<?php

namespace Modules\Expenses\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Expenses\Entities\Expense;
use Modules\Expenses\Http\Requests\ExpenseRequest;
use Modules\Expenses\Transformers\ExpenseResource;
use Modules\Expenses\Transformers\ExpensesResource;
use Modules\Files\Helpers\Uploader;

class ExpensesApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Expense model
     *
     * @var \Modules\Expenses\Entities\Expense
     */
    protected $expense;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->expense = new Expense;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $expenses = new ExpensesResource(
            $this->expense->whereNull('archived_at')
                ->orderBy('id', 'desc')
                ->paginate(40)
        );
        return response($expenses, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $expense = $this->expense->findOrFail($id);
        return response(new ExpenseResource($expense), Response::HTTP_OK);
    }
    /**
     * Save expense
     */
    public function save(ExpenseRequest $request)
    {
        $expense = $this->expense->create($request->except(['tags', 'uploads']));
        $this->updateClient($expense, $request);

        if ($request->hasFile('uploads')) {
            $this->makeUploads($expense, $request);
        }
        if ($request->has('recurring') && $request->recurring['frequency'] != 'none') {
            $expense->recur();
        } else {
            $expense->stopRecurring();
        }
        return ajaxResponse(
            [
                'id'       => $expense->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('expenses.view', $expense->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }
    /**
     * Update expense
     */
    public function update(ExpenseRequest $request, $id = null)
    {
        $expense = $this->expense->findOrFail($id);
        $expense->update($request->except(['id', 'uploads', 'tags']));
        $this->updateClient($expense, $request);

        if ($request->hasFile('uploads')) {
            $this->makeUploads($expense, $request);
        }
        if ($request->has('recurring') && $request->recurring['frequency'] != 'none') {
            $expense->recur();
        } else {
            $expense->stopRecurring();
        }
        return ajaxResponse(
            [
                'id'       => $expense->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('expenses.view', $expense->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Duplicate expense
     */
    public function copy($id = null)
    {
        $expense    = $this->expense->findOrFail($id);
        $newExpense = $expense->replicate();
        $newExpense->save();
        $newExpense->retag($expense->tagList);
        return ajaxResponse(
            [
                'id'       => $newExpense->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('expenses.view', $newExpense->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    protected function updateClient($expense, $request)
    {
        $expense->unsetEventDispatcher();
        if ($request->project_id == 0) {
            $expense->update(['client_id' => $request->client_id]);
        } else {
            $expense->update(['client_id' => $expense->AsProject->client_id]);
        }
    }

    /**
     * Display expense comments
     */
    public function comments($id = null)
    {
        $expense  = $this->expense->findOrFail($id);
        $comments = new CommentsResource($expense->comments()->orderBy('id', 'desc')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }
    /**
     * Delete expense
     */
    public function delete($id = null)
    {
        $expense = $this->expense->findOrFail($id);
        $expense->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('expenses.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Make expense uploads
     */
    protected function makeUploads($expense, $request)
    {
        $request->request->add(['module' => 'expenses']);
        $request->request->add(['module_id' => $expense->id]);
        $request->request->add(['title' => $expense->code]);
        $request->request->add(['description' => 'Expense ' . $expense->code . ' file']);

        return (new Uploader)->save('uploads/expenses', $request);
    }
}
