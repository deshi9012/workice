<?php

namespace Modules\Deals\Http\Controllers\Base;

use App\Entities\Category;
use App\Helpers\ExcelImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVRequest;
use DataTables;
use Illuminate\Http\Request;
use Modules\Deals\Entities\Deal;
use Modules\Deals\Exports\DealsExport;

abstract class DealsController extends Controller
{
    /**
     * Whether to display deals in kanban or table
     *
     * @var string
     */
    public $dealDisplayType;
    /**
     * The deal pipeline to display
     *
     * @var string
     */
    public $dealPipeline;
    /**
     * Deal model
     *
     * @var \Modules\Deals\Entities\Deal
     */
    public $deal;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    public $request;
    /**
     * Current page name
     *
     * @var string
     */
    public $page;

    public function __construct(Deal $deal, Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_deals']);
        $this->dealDisplayType = request('view', 'kanban');
        $this->dealPipeline    = request('pipeline', get_option('default_deal_pipeline'));
        $this->deal            = $deal;
        $this->request         = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']        = $this->getPage();
        $data['dealDisplay'] = $this->getDisplayType();
        $data['pipeline']    = $this->getPipeline();
        $data['filter']      = $this->request->filter;
        $data['deals']       = $this->deal->whereNull('archived_at')->open()->wherePipeline($this->getPipeline())->with(['contact:id,username,name', 'user:id,username,name'])->orderByDesc('id')->get();
        $data['cards']       = Category::deals()->wherePipeline($data['pipeline'])->orderBy('order')->get();

        return view('deals::index')->with($data);
    }
    // Show create deal form
    public function create()
    {
        $data['categories'] = Category::whereModule('deals')->get();
        $data['contact']    = request('contact', null);
        $data['company']    = request('company', null);

        return view('deals::modal.create')->with($data);
    }
    // Show edit deal form
    public function edit(Deal $deal)
    {
        $data['deal']       = $deal;
        $data['categories'] = Category::whereModule('deals')->wherePipeline($deal->pipeline)->get();

        return view('deals::modal.update')->with($data);
    }
    // Show deal overview
    public function view(Deal $deal, $tab = 'overview', $option = null)
    {
        $allowedTabs    = ['activity', 'calls', 'calendar', 'comments', 'compose', 'emails', 'files', 'overview', 'products'];
        $data['tab']    = in_array($tab, $allowedTabs) ? $tab : 'overview';
        $data['page']   = $this->getPage();
        $data['deal']   = $deal;
        $data['option'] = $option;

        return view('deals::view')->with($data);
    }
    // Confirm deal delete
    public function delete(Deal $deal)
    {
        $data['deal'] = $deal;

        return view('deals::modal.delete')->with($data);
    }
    // Delete deal
    public function destroy(Request $request, Deal $deal)
    {
        $deal->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect()->route('deals.index');
    }
    // Bulk delete deals
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            \Modules\Deals\Jobs\BulkDeleteDeals::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No deals selected', 'errors' => ['missing' => ["Please select atleast 1 deal"]]], 500);
    }

    // Export deals as CSV
    public function export()
    {
        if (isAdmin()) {
            return (new DealsExport)->download('deals_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }
    // Import deals
    public function import()
    {
        $data['page'] = $this->getPage();

        return view('deals::modal.uploadcsv')->with($data);
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

        return view('deals::import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'))->with($dt);
    }

    public function processImport()
    {
        \Validator::make(
            array_flip($this->request->fields),
            [
                'title'          => 'required',
                'pipeline'       => 'required',
                'stage_id'       => 'required',
                'contact_person' => 'required',
            ]
        )->validate();
        (new \Modules\Deals\Helpers\DealCsvProcessor)->import($this->request);

        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('deals.index');

        return ajaxResponse($data);
    }
    // Mark a deal as lost
    public function lost(Deal $deal)
    {
        $data['deal'] = $deal;

        return view('deals::modal.lost')->with($data);
    }

    public function open(Deal $deal)
    {
        $deal->update(
            [
                'status' => 'open', 'won_time' => null, 'lost_time' => null, 'lost_reason' => null, 'archived_at' => null,
            ]
        );
        $deal->isOpen();
        toastr()->info(langapp('action_completed'), langapp('response_status'));

        return redirect()->route('deals.view', ['id' => $deal->id]);
    }

    /**
     * Win deal
     */
    public function win(Deal $deal)
    {
        $data['deal'] = $deal;

        return view('deals::modal.win')->with($data);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with('category:id,name', 'company:id,name,expense,balance,currency', 'contact:id,username,name');

        return DataTables::eloquent($model)
            ->editColumn(
                'title',
                function ($deal) {
                    return '<a href="' . route('deals.view', $deal->id) . '">' . str_limit($deal->title, 25) . '</a>';
                }
            )
            ->editColumn(
                'deal_value',
                function ($deal) {
                    return '<strong>' . $deal->computed_value . '</strong>';
                }
            )
            ->editColumn(
                'chk',
                function ($deal) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $deal->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'stage',
                function ($deal) {
                    return optional($deal->category)->name;
                }
            )
            ->editColumn(
                'organization',
                function ($deal) {
                    return '<a href="' . route('clients.view', $deal->organization) . '">' . str_limit(optional($deal->company)->name, 25) . '</a>';
                }
            )
            ->editColumn(
                'contact_person',
                function ($deal) {
                    return '<a href="' . route('contacts.view', $deal->contact_person) . '">' . str_limit(optional($deal->contact)->name, 25) . '</a>';
                }
            )
            ->editColumn(
                'due_date',
                function ($deal) {
                    return dateFormatted($deal->due_date);
                }
            )
            ->rawColumns(['title', 'deal_value', 'chk', 'contact_person', 'organization'])
            ->make(true);
    }

    protected function applyFilter()
    {
        if ($this->request->filter === 'archived') {
            return $this->deal->apply(['archived' => 1]);
        }
        if ($this->request->filter === 'won') {
            return $this->deal->apply(['status' => 'won']);
        }
        if ($this->request->filter === 'lost') {
            return $this->deal->apply(['status' => 'lost']);
        }
        return $this->deal->apply(['pipeline' => $this->getPipeline()])->open()->whereNull('archived_at');
    }
    // Determine how deals are displayed
    protected function getDisplayType()
    {
        if (!is_null($this->request->view)) {
            session(['dealview' => $this->dealDisplayType]);
        }
        return session('dealview', $this->dealDisplayType);
    }
    // Determine the deal pipeline to display
    protected function getPipeline()
    {
        if ($this->request->filled('pipeline')) {
            session(['dealpipeline' => $this->dealPipeline]);
        }
        return session('dealpipeline', $this->dealPipeline);
    }

    private function getPage()
    {
        return langapp('deals');
    }
}
