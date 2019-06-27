<?php

namespace Modules\Expenses\Http\Controllers\Base;

use App\Helpers\ExcelImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVRequest;
use DataTables;
use Illuminate\Http\Request;
use Modules\Expenses\Entities\Expense;
use Modules\Expenses\Exports\ExpensesExport;
use Modules\Expenses\Helpers\ExpenseCsvProcessor;
use Modules\Expenses\Jobs\BillExpenses;
use Modules\Expenses\Jobs\BulkDeleteExpenses;

class ExpensesController extends Controller
{
    /**
     * Request Instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Expense model
     *
     * @var \Modules\Expenses\Entities\Expense description
     */
    protected $expense;
    /**
     * Current page name
     *
     * @var string
     */
    protected $page;
    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_expenses']);
        $this->expense = new Expense;
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']   = $this->getPage();
        $data['filter'] = $this->request->filter;

        return view('expenses::index')->with($data);
    }
    /**
     * Show expense overview
     */
    public function view(Expense $expense)
    {
        $data['page']    = $this->getPage();
        $data['expense'] = $expense;

        return view('expenses::view')->with($data);
    }
    /**
     * Show create expense modal
     */
    public function create($project = null)
    {
        $data['selected_project'] = $this->request->project;

        return view('expenses::modal.create')->with($data);
    }
    /**
     * Show Duplicate expense modal
     */
    public function copy(Expense $expense)
    {
        $data['expense'] = $expense;

        return view('expenses::modal.copy')->with($data);
    }
    /**
     * Show update expense modal
     */
    public function edit(Expense $expense)
    {
        $data['form']    = true;
        $data['expense'] = $expense;

        return view('expenses::modal.update')->with($data);
    }
    /**
     * Hide expense from client
     */
    public function hide(Expense $expense)
    {
        $expense->update(['is_visible' => 0]);
        toastr()->warning(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('expenses.view', ['id' => $expense->id]);
    }
    /**
     * Show expense to client
     */
    public function show(Expense $expense)
    {
        $expense->update(['is_visible' => 1]);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('expenses.view', ['id' => $expense->id]);
    }
    /**
     * Show import expenses form
     */
    public function import()
    {
        $data['page'] = $this->getPage();

        return view('expenses::uploadcsv')->with($data);
    }

    public function parseImport(CSVRequest $request, ExcelImport $importer)
    {
        $dt['page'] = $this->getPage();
        $path       = $request->file('csvfile')->getRealPath();
        if ($request->has('header')) {
            $data = $importer->getData($path);
        } else {
            $data = array_map('str_getcsv', file($path));
        }
        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data      = array_slice($data, 0, 2);
            $csv_data_file = \App\Entities\CsvData::create(
                [
                    'csv_filename' => $request->file('csvfile')->getClientOriginalName(),
                    'csv_header'   => $request->has('header'),
                    'csv_data'     => json_encode($data),
                ]
            );
        } else {
            return redirect()->back();
        }

        return view('expenses::import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'))->with($dt);
    }

    public function processImport()
    {
        $validator = \Validator::make(
            array_flip($this->request->fields),
            [
                'code'      => 'required',
                'client_id' => 'required',
                'amount'    => 'required',
            ]
        )->validate();
        (new ExpenseCsvProcessor)->import($this->request);

        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('expenses.index');

        return ajaxResponse($data);
    }

    /**
     * Download expenses as CSV
     */
    public function export()
    {
        if (isAdmin()) {
            return (new ExpensesExport)->download('expenses_' . now()->toIso8601String() . '.csv');
        }
        abort(401);
    }
    /**
     * Confirm Delete expense
     */
    public function delete(Expense $expense)
    {
        $data['expense'] = $expense;
        return view('expenses::modal.delete')->with($data);
    }
    /**
     * Bill multiple expenses
     */
    public function bulkBill()
    {
        if ($this->request->has('checked')) {
            BillExpenses::dispatch($this->request->checked, \Auth::id())->onQueue('high');
            $data['message']  = langapp('saved_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No expenses selected', 'errors' => ['missing' => ["Please select atleast 1 expense"]]], 500);
    }
    /**
     * Delete multiple expenses
     */
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            BulkDeleteExpenses::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No expenses selected', 'errors' => ['missing' => ["Please select atleast 1 expense"]]], 500);
    }

    /**
     * Get expenses for display in table
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with(['company:id,name,currency', 'AsProject:id,name', 'AsCategory:id,name']);

        return DataTables::eloquent($model)
            ->editColumn(
                'code',
                function ($expense) {
                    $str = $expense->statusIcon();
                    $str .= '<a href="' . route('expenses.view', $expense->id) . '"> ' . $expense->code . '</a>';
                    return $str;
                }
            )
            ->editColumn(
                'chk',
                function ($expense) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $expense->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'project_id',
                function ($expense) {
                    return optional($expense->AsProject)->id > 0 ? '<a href="' . route('projects.view', $expense->project_id) . '">' . str_limit($expense->AsProject->name, 15) . '</a>' : 'N/A';
                }
            )
            ->editColumn(
                'client_id',
                function ($expense) {
                    return optional($expense->company)->id > 0 ? '<a href="' . route('clients.view', $expense->client_id) . '">' . str_limit($expense->company->name, 15) . '</a>' : 'N/A';
                }
            )
            ->editColumn(
                'cost',
                function ($expense) {
                    return formatCurrency($expense->currency, $expense->amount);
                }
            )
            ->editColumn(
                'invoiced',
                function ($expense) {
                    return $expense->invoiced == 1 ? '<span class="text-success text-uc">' . langapp('yes') . '</span>' : '<span class="text-uc text-dark">' . langapp('no') . '</span>';
                }
            )
            ->editColumn(
                'category',
                function ($expense) {
                    return str_limit($expense->AsCategory->name, 15);
                }
            )
            ->editColumn(
                'expense_date',
                function ($expense) {
                    return dateString($expense->expense_date);
                }
            )
            ->rawColumns(['project_id', 'client_id', 'chk', 'invoiced', 'code'])
            ->make(true);
    }

    protected function applyFilter()
    {
        if ($this->request->filter === 'billed') {
            return $this->expense->apply(['invoiced' => 1])->whereNull('archived_at');
        }
        if ($this->request->filter === 'billable') {
            return $this->expense->apply(['billable' => 1])->whereNull('archived_at');
        }
        if ($this->request->filter === 'recurring') {
            return $this->expense->apply(['recurring' => 1])->whereNull('archived_at');
        }
        if ($this->request->filter === 'archived') {
            return $this->expense->apply(['archived' => 1]);
        }
        return $this->expense->query()->whereNull('archived_at');
    }

    private function getPage()
    {
        return langapp('expenses');
    }
}
