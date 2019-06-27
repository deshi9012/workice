<?php

namespace Modules\Clients\Http\Controllers\Base;

use App\Helpers\ExcelImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVRequest;
use DataTables;
use Illuminate\Http\Request;
use Modules\Clients\Emails\ClientMail;
use Modules\Clients\Entities\Client;
use Modules\Clients\Exports\ClientsExport;
use Modules\Clients\Helpers\ClientsCsvProcessor;
use Modules\Contacts\Http\Requests\MailRequest;

abstract class ClientsController extends Controller
{
    /**
     * Client model
     *
     * @var \Modules\Clients\Entities\Client
     */
    protected $client;
    /**
     * Page name
     *
     * @var string
     */
    protected $page;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Client logo uploads DIR
     *
     * @var string
     */
    protected $logos_dir;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_clients']);
        $this->client  = new Client;
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
        return view('clients::index')->with($data);
    }

    public function view(Client $client, $tab = 'dashboard')
    {
        $data['page']    = $this->getPage();
        $data['tab']     = $tab;
        $data['company'] = $client;

        return view('clients::view')->with($data);
    }

    public function create()
    {
        return view('clients::modal.create');
    }

    public function email(Client $client)
    {
        $data['client'] = $client;

        return view('clients::modal.send')->with($data);
    }

    public function send(MailRequest $request)
    {
        $client = $this->client->findOrFail($request->id);
        $mail   = $client->emails()->create(
            [
                'to'      => $request->id,
                'from'    => \Auth::id(),
                'subject' => $request->subject,
                'message' => $request->message,
            ]
        );
        if ($request->hasFile('uploads')) {
            $this->makeUploads($mail, $request);
        }
        \Mail::to($client)->send(new ClientMail($mail, \Auth::user()->profile->email_signature));

        $data['message']  = langapp('sent_successfully');
        $data['redirect'] = route('clients.view', ['id' => $request->id]);

        return ajaxResponse($data);
    }

    public function edit(Client $client)
    {
        $data['client'] = $client;

        return view('clients::modal.update')->with($data);
    }

    public function import()
    {
        $data['page'] = $this->getPage();

        return view('clients::modal.uploadcsv')->with($data);
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
            toastr()->info('CSV file not processed', langapp('response_status'));

            return redirect()->back();
        }

        return view('clients::import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'))->with($dt);
    }

    public function processImport()
    {
        $validator = \Validator::make(
            array_flip($this->request->fields),
            [
                'name'  => 'required',
                'email' => 'required',
            ]
        )->validate();
        (new ClientsCsvProcessor)->import($this->request);

        $data['message']  = langapp('data_imported');
        $data['redirect'] = route('clients.index');

        return ajaxResponse($data);
    }

    public function export()
    {
        if (isAdmin()) {
            return (new ClientsExport)->download('clients_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }

    public function delete(Client $client)
    {
        $data['client'] = $client;

        return view('clients::modal.delete')->with($data);
    }

    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            \Modules\Clients\Jobs\BulkDeleteClients::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No clients selected', 'errors' => ['missing' => ["Please select atleast 1 client"]]], 500);
    }

    protected function makeUploads($mail, $request)
    {
        $request->request->add(['module' => 'emails']);
        $request->request->add(['module_id' => $mail->id]);
        $request->request->add(['title' => $mail->subject]);
        $request->request->add(['description' => 'Email ' . $mail->subject . ' file']);

        return (new \Modules\Files\Helpers\Uploader)->save('uploads/emails', $request);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect()->route('clients.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter($this->request->filter);
        return DataTables::eloquent($model)
            ->editColumn(
                'name',
                function ($client) {
                    $str = '<a class="thumb-xs avatar"> <img src="' . $client->logo . '" class="img-circle"></a>';
                    return $str . ' <a href="' . route('clients.view', $client->id) . '">' . $client->name . '</a>';
                }
            )
            ->editColumn(
                'chk',
                function ($client) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $client->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'outstanding',
                function ($client) {
                    return $client->balance > 0 ? '<span class="text-danger">' . $client->outstanding . '</span>' : $client->outstanding;
                }
            )
            ->rawColumns(['name', 'chk', 'outstanding'])
            ->make(true);
    }

    private function applyFilter($filter)
    {
        $query = $this->client->query();
        $query->when(
            $filter == 'expenses',
            function ($q) {
                return $q->where('expense', '>', 0);
            }
        );
        $query->when(
            $filter == 'balance',
            function ($q) {
                return $q->where('balance', '>', 0);
            }
        );
        $query->when(
            $filter == 'prospects',
            function ($q) {
                return $q->whereDoesntHave('invoices');
            }
        );
        $query->when(
            $filter == 'customers',
            function ($q) {
                return $q->whereHas('invoices');
            }
        );
        return $query;
    }

    private function getPage()
    {
        return langapp('accounts');
    }
}
