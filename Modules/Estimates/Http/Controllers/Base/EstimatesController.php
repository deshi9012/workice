<?php

namespace Modules\Estimates\Http\Controllers\Base;

use App\Helpers\ExcelImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVRequest;
use DataTables;
use Illuminate\Http\Request;
use Modules\Estimates\Entities\Estimate;
use Modules\Estimates\Events\EstimateAccepted;
use Modules\Estimates\Exports\EstimatesExport;
use Modules\Invoices\Entities\Invoice;

abstract class EstimatesController extends Controller
{
    /**
     * Current page name
     *
     * @var string
     */
    public $page;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    public $request;
    /**
     * Estimate model
     *
     * @var \Modules\Estimates\Entities\Estimate
     */
    public $estimate;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_estimates']);
        $this->request  = $request;
        $this->estimate = new Estimate;
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

        return view('estimates::index')->with($data);
    }
    /**
     * Show estimate overview
     */
    public function view(Estimate $estimate)
    {
        $data['page']     = $this->getPage();
        $data['estimate'] = $estimate;

        return view('estimates::view')->with($data);
    }
    /**
     * Show create estimate page
     */
    public function create($client = null)
    {
        $data['page']         = $this->getPage();
        $data['selectClient'] = $client;
        return view('estimates::create')->with($data);
    }
    /**
     * Show update estimate page
     */
    public function edit(Estimate $estimate)
    {
        $data['page']     = $this->getPage();
        $data['estimate'] = $estimate;

        return view('estimates::update')->with($data);
    }
    /**
     * Show share estimate modal
     */
    public function share($id)
    {
        $data['id'] = $id;

        return view('estimates::modal.share')->with($data);
    }
    /**
     * Duplicate estimate modal
     */
    public function duplicate(Estimate $estimate)
    {
        $data['estimate'] = $estimate;

        return view('estimates::modal.duplicate')->with($data);
    }

    /**
     * Show estimate comments
     */
    public function comments(Estimate $estimate)
    {
        $data['estimate'] = $estimate;

        return view('estimates::modal.comments')->with($data);
    }
    /**
     * Show send estimate form
     */
    public function send(Estimate $estimate)
    {
        $data['estimate'] = $estimate;

        return view('estimates::modal.send')->with($data);
    }

    public function import()
    {
        $data['page'] = $this->getPage();

        return view('estimates::modal.uploadcsv')->with($data);
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

        return view('estimates::import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'))->with($dt);
    }

    public function processImport()
    {
        $validator = \Validator::make(
            array_flip($this->request->fields),
            [
                'reference_no' => 'required',
                'client_id'    => 'required',
                'due_date'     => 'required',
                'name'         => 'required',
                'unit_cost'    => 'required',
                'quantity'     => 'required',
            ]
        )->validate();
        (new \Modules\Estimates\Helpers\EstimateCsvProcessor)->import($this->request);

        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('estimates.index');

        return ajaxResponse($data);
    }

    /**
     * Export estimates as CSV
     */
    public function export()
    {
        if (isAdmin()) {
            return (new EstimatesExport)->download('estimates_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }
    /**
     * Convert estimate to invoice modal
     */
    public function convert(Estimate $estimate)
    {
        $data['estimate'] = $estimate;

        return view('estimates::modal.invoice')->with($data);
    }
    /**
     * Convert estimate to project modal
     */
    public function toProject(Estimate $estimate)
    {
        $data['estimate'] = $estimate;

        return view('estimates::modal.project')->with($data);
    }

    /**
     * Decline estimate modal
     */
    public function declined(Estimate $estimate)
    {
        $data['estimate'] = $estimate;

        return view('estimates::modal.decline')->with($data);
    }
    /**
     * Mark estimate as accepted modal
     */
    public function accepted(Estimate $estimate)
    {
        event(new EstimateAccepted($estimate, \Auth::id()));

        toastr()->success(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('estimates.view', ['id' => $estimate->id]);
    }

    /**
     * Show estimate to client
     */
    public function show(Estimate $estimate)
    {
        $estimate->update(['is_visible' => 1]);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('estimates.view', ['id' => $estimate->id]);
    }
    /**
     * Hide estimate from client
     */
    public function hide(Estimate $estimate)
    {
        $estimate->update(['is_visible' => 0]);
        toastr()->warning(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('estimates.view', ['id' => $estimate->id]);
    }
    /**
     * Download estimate as PDF
     */
    public function pdf(Estimate $estimate)
    {
        if (isset($estimate->id)) {
            return $estimate->pdf();
        }
        abort(404);
    }
    /**
     * Show estimate activities
     */
    public function activity(Estimate $estimate)
    {
        $data['activities'] = $estimate->activities;

        return view('partial.activity')->with($data);
    }
    /**
     * Delete estimate modal
     */
    public function delete(Estimate $estimate)
    {
        $data['estimate'] = $estimate;

        return view('estimates::modal.delete')->with($data);
    }
    /**
     * Bulk delete estimates
     */
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            \Modules\Estimates\Jobs\BulkDeleteEstimates::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No estimates selected', 'errors' => ['missing' => ["Please select atleast 1 estimate"]]], 500);
    }
    /**
     * Send estimates in bulk to clients
     */
    public function bulkSend()
    {
        if ($this->request->has('checked')) {
            \Modules\Estimates\Jobs\BulkSendEstimates::dispatch($this->request->checked, \Auth::id())->onQueue('high');
            $data['message']  = langapp('sent_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No estimates selected', 'errors' => ['missing' => ["Please select atleast 1 estimate"]]], 500);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with(['company:id,name,currency']);

        return DataTables::eloquent($model)
            ->editColumn(
                'reference_no',
                function ($estimate) {
                    $str = $estimate->statusIcon();
                    $str .= '<a href="' . route('estimates.view', $estimate->id) . '"> ' . $estimate->reference_no . '</a>';
                    return $str;
                }
            )
            ->editColumn(
                'chk',
                function ($estimate) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $estimate->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'client_id',
                function ($estimate) {
                    return optional($estimate->company)->id > 0 ? '<a href="' . route('clients.view', $estimate->client_id) . '">' . str_limit($estimate->company->name, 15) . '</a>' : 'N/A';
                }
            )
            ->editColumn(
                'due_date',
                function ($estimate) {
                    return dateString($estimate->due_date);
                }
            )
            ->editColumn(
                'status',
                function ($estimate) {
                    return '<span class="label label-info label-rounded">' . $estimate->status . '</span>';
                }
            )
            ->editColumn(
                'amount',
                function ($estimate) {
                    return formatCurrency($estimate->currency, $estimate->amount);
                }
            )
            ->editColumn(
                'created_at',
                function ($estimate) {
                    return dateString($estimate->created_at);
                }
            )
            ->rawColumns(['reference_no', 'chk', 'client_id', 'status'])
            ->make(true);
    }

    protected function applyFilter()
    {
        if ($this->request->filter === 'pending') {
            return $this->estimate->apply(['status' => 'Pending'])->whereNull('archived_at');
        }
        if ($this->request->filter === 'accepted') {
            return $this->estimate->apply(['status' => 'Accepted']);
        }
        if ($this->request->filter === 'declined') {
            return $this->estimate->apply(['status' => 'Declined']);
        }
        if ($this->request->filter === 'invoiced') {
            return $this->estimate->apply(['invoiced_id' => 1]);
        }
        if ($this->request->filter === 'archived') {
            return $this->estimate->apply(['archived' => 1]);
        }
        return $this->estimate->query()->whereNull('archived_at');
    }

    private function getPage()
    {
        return langapp('estimates');
    }
}
