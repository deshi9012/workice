<?php

namespace Modules\Leads\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\CSVRequest;
use App\Http\Requests\EmailRequest;
use DataTables;
use Illuminate\Http\Request;
use Modules\Files\Helpers\Uploader;
use Modules\Leads\Emails\LeadsBulkEmail;
use Modules\Leads\Emails\RequestConsent;
use Modules\Leads\Entities\Lead;
use Modules\Leads\Exports\LeadsExport;
use Modules\Leads\Helpers\LeadCsvProcessor;
use Modules\Leads\Http\Requests\BulkSendRequest;
use Modules\Leads\Jobs\BulkDeleteLeads;
use Modules\Messages\Entities\Emailing;
use App\Entities\Category;
use Carbon\Carbon;

abstract class LeadsController extends Controller {
    /**
     * Lead model
     *
     * @var \Modules\Leads\Entities\Lead
     */
    public $lead;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    public $request;
    /**
     * Lead display type kanban|table
     *
     * @var string
     */
    public $displayType;

    public function __construct(Lead $lead, Request $request) {
        $this->middleware([
            'auth',
            'verified',
            '2fa',
            'can:menu_leads'
        ]);

        $this->displayType = request('view', 'table');
        $this->request = $request;
        $this->lead = $lead;


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {

        $data['page'] = $this->getPage();
        $data['displayType'] = $this->getDisplayType();
        $data['filter'] = $this->request->filter;

        return view('leads::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('leads::modal.create');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function view(Lead $lead, $tab = 'overview', $option = null) {
        $allowedTabs = [
            'activity',
            'calendar',
            'comments',
            'compose',
            'conversations',
            'files',
            'calls',
            'overview'
        ];
        $data['tab'] = in_array($tab, $allowedTabs) ? $tab : 'overview';
        $data['page'] = $this->getPage();
        $data['lead'] = $lead;
        $data['option'] = $option;

        return view('leads::view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Lead $lead) {

        $data['lead'] = $lead;
        return view('leads::modal.update')->with($data);
    }

    /**
     * Show modal to convert lead
     */
    public function convert(Lead $lead) {
        $data['lead'] = $lead;
        return view('leads::modal.convert')->with($data);
    }

    /**
     * Export Leads as CSV
     */
    public function export() {
        if (isAdmin()) {
            return (new LeadsExport)->download('leads_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }

    /**
     * Show import leads form
     */
    public function import() {
        if ($this->request->type == 'google') {
            return $this->importGoogleContacts();
        }

        $data['page'] = $this->getPage();

        return view('leads::modal.uploadcsv')->with($data);
    }

    public function nextStage(Lead $lead) {
        $data['lead'] = $lead;
        return view('leads::modal.next_stage')->with($data);
    }

    public function parseImport(CSVRequest $request, \App\Helpers\ExcelImport $importer) {
        ini_set('max_execution_time', 300);

        $dt['page'] = $this->getPage();


        $path = $request->file('csvfile')->getRealPath();
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
            $csv_data = array_slice($data, 0, 2);
            $csv_data_file = \App\Entities\CsvData::create([
                'csv_filename' => $request->file('csvfile')->getClientOriginalName(),
                'csv_header'   => $request->has('header'),
                'csv_data'     => json_encode($data),
            ]);
        } else {
            return redirect()->back();
        }

        return view('leads::import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'))->with($dt);
    }

    /**
     * Send consent request to lead
     */
    public function sendConsent(Lead $lead) {
        if (is_null($lead->token)) {
            $lead->update(['token' => genToken()]);
        }
        \Mail::to($lead)->send(new RequestConsent($lead));
        toastr()->success(langapp('sent_successfully'), langapp('response_status'));

        return redirect()->route('leads.view', ['id' => $lead->id]);
    }

    public function processImport() {
        \Validator::make(array_flip($this->request->fields), [
            'name'    => 'required',
            'company' => 'required',
            'email'   => 'required',
        ])->validate();
        (new LeadCsvProcessor)->import($this->request);

        $data['message'] = langapp('saved_successfully');
        $data['redirect'] = route('leads.index');

        return ajaxResponse($data);
    }

    /**
     * Confirm delete
     */
    public function delete(Lead $lead) {
        $data['lead'] = $lead;

        return view('leads::modal.delete')->with($data);
    }

    /**
     * Send email to lead
     */
    public function email(EmailRequest $request, Lead $lead) {
        $when = empty($request->reserved_at) ? now()->addMinutes(1) : dateParser($request->reserved_at);
        $request->request->add([
            'meta' => [
                'sender' => \Auth::user()->email,
                'to'     => $lead->email
            ]
        ]);
        $request->request->add(['reserved_at' => $when->toDateTimeString()]);
        $request->request->add(['message' => str_replace("{name}", $lead->name, $request->message)]);
        $mail = $lead->emails()->create($request->except([
            'uploads',
            'selectCanned'
        ]));

        if ($request->hasFile('uploads')) {
            $this->makeUploads($mail, $request);
        }

        \Mail::to($lead)->later($when, new LeadsBulkEmail($mail, \Auth::user()->profile->email_signature));

        $data['message'] = langapp('sent_successfully');
        $data['redirect'] = route('leads.view', [
            'id'  => $lead->id,
            'tab' => 'conversations'
        ]);

        return ajaxResponse($data);
    }

    protected function makeUploads($mail, $request) {
        $request->request->add(['module' => 'emails']);
        $request->request->add(['module_id' => $mail->id]);
        $request->request->add(['title' => $mail->subject]);
        $request->request->add(['description' => 'Email ' . $mail->subject . ' file']);

        return (new Uploader)->save('uploads/emails', $request);
    }

    public function replyEmail(EmailRequest $request) {
        $recipients = explode(',', trim($request->to));
        $email = Emailing::create($request->except(['to']));

        $email->update([
            'from' => \Auth::id(),
            'meta' => [
                'sender' => \Auth::user()->email,
                'to'     => $recipients
            ],
        ]);
        $data['message'] = langapp('sent_successfully');
        $data['redirect'] = route('leads.view', [
            'id'     => $email->lead->id,
            'tab'    => 'emails',
            'action' => $request->reply_id,
        ]);

        return ajaxResponse($data);
    }

    /**
     * Select leads to send email
     */
    public function bulkEmail() {
        if ($this->request->has('checked')) {
            $data['page'] = $this->getPage();
            $data['leads'] = $this->lead->whereIn('id', $this->request->checked)->select('id', 'name', 'email')->get();

            return view('leads::bulkEmail')->with($data);
        }
        return response()->json([
            'message' => 'No leads selected',
            'errors'  => ['missing' => ["Please select atleast 1 lead"]]
        ], 500);
    }

    /**
     * Send email to multiple leads
     */
    public function sendBulk(BulkSendRequest $request) {
        $when = empty($request->later_date) ? now()->addMinutes(1) : dateParser($request->later_date);
        if ($request->has('leads')) {
            foreach ($request->leads as $l) {
                $lead = $this->lead->findOrFail($l);
                $mail = $lead->emails()->create([
                    'to'          => $lead->id,
                    'from'        => \Auth::id(),
                    'subject'     => $request->subject,
                    'message'     => str_replace("{name}", $lead->name, $request->message),
                    'reserved_at' => $when->toDateTimeString(),
                    'meta'        => [
                        'sender' => get_option('company_email'),
                        'to'     => $lead->email,
                    ],
                ]);
                \Mail::to($lead)->bcc(!empty($request->bcc) ? $request->bcc : [])->later($when, new LeadsBulkEmail($mail, \Auth::user()->profile->email_signature));
            }
        }
        $data['message'] = langapp('sent_successfully');
        $data['redirect'] = route('leads.index');

        return ajaxResponse($data);
    }

    /**
     * Delete multiple leads
     */
    public function bulkDelete() {
        if ($this->request->has('checked')) {
            BulkDeleteLeads::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message'] = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json([
            'message' => 'No leads selected',
            'errors'  => ['missing' => ["Please select atleast 1 lead"]]
        ], 500);
    }

    public function ajaxDeleteMail() {
        if ($this->request->ajax()) {
            Emailing::findOrFail($this->request->id)->delete();
            return response()->json([
                'status'  => 'success',
                'message' => langapp('deleted_successfully')
            ], 200);
        }
    }

    /**
     * Get leads for display in datatable
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData() {

        $model = $this->applyFilter()->with('status:id,name', 'agent:id,username,name');
        $sourceData = Category::whereModule('source')->get()->toArray();

        $allSources = [];
        foreach ($sourceData as $key => $item) {
            $allSources[$item['id']] = $item['name'];
        }
        $data = DataTables::eloquent($model)->editColumn('name', function ($lead) {
            ini_set('max_execution_time', 300);

            $str = '<a href="' . route('leads.view', $lead->id) . '">';
            if ($lead->has_email) {
                $str .= '<i class="fas fa-envelope-open text-danger"></i> ';
            }
            return $str . str_limit($lead->name, 15) . '</a>';
        })->editColumn('chk', function ($lead) {
            return '<label><input type="checkbox" name="checked[]" value="' . $lead->id . '"><span class="label-text"></span></label>';
        })->editColumn('mobile', function ($lead) {
            return str_limit($lead->mobile, 15);
        })->editColumn('email', function ($lead) {
            $str = '<a href="' . route('leads.view', [
                    'lead' => $lead->id,
                    'tab'  => 'conversations'
                ]) . '">';
            return $str . $lead->email . '</a>';
        })->editColumn('lead_value', function ($lead) {
            return formatCurrency(get_option('default_currency'), (float)$lead->lead_value);
        })->editColumn('stage', function ($lead) {
            return '<span class="text-dark">' . str_limit($lead->status->name, 15) . '</span>';
        })->editColumn('sales_rep', function ($lead) {
            return str_limit(optional($lead->agent)->name, 15);
        })->editColumn('source', function ($lead) use ($allSources) {
            return $allSources[$lead->source];
        })->editColumn('approx_time', function ($lead) {
            $carbon = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now(), 'UTC');
            return $carbon->tz($lead->timezone)->toTimeString();
        })->editColumn('registration_time', function ($lead) {
            if($lead->created_at) {
                return $lead->created_at->toDateTimeString();
            }

        })->editColumn('modified_time', function ($lead) {
            if($lead->updated_at) {
                return $lead->updated_at->toDateTimeString();
            }
        })->editColumn('local_time', function ($lead) {
            $carbon = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now(), 'UTC');
            return $carbon->tz($lead->timezone)->toTimeString();
        })->rawColumns([
            'id',
            'name',
            'mobile',
            'stage',
            'chk',
            'lead',
            'email',
            'language'
        ])->make(true);

        return $data;
    }

    public function importGoogleContacts() {
        $code = $this->request->code;
        $googleService = \OAuth::consumer('Google', route('leads.import.callback'));
        if (!is_null($code)) {
            $token = $googleService->requestAccessToken($code);
            $result = json_decode($googleService->request('https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=1500'), true);
            session(['lock_assigned_alert' => true]);
            foreach ($result['feed']['entry'] as $contact) {
                if (isset($contact['gd$email'])) {
                    $data = [];
                    $data['name'] = isset($contact['title']['$t']) ? $contact['title']['$t'] : $contact['gd$email'][0]['address'];
                    $data['source'] = 'Google Contacts';
                    $data['stage_id'] = get_option('default_lead_stage');
                    $data['job_title'] = isset($contact['gd$organization'][0]['gd$orgTitle']['$t']) ? $contact['gd$organization'][0]['gd$orgTitle']['$t'] : '';
                    $data['company'] = isset($contact['gd$organization'][0]['gd$orgName']['$t']) ? $contact['gd$organization'][0]['gd$orgName']['$t'] : '';
                    $data['phone'] = isset($contact['gd$phoneNumber'][0]['$t']) ? $contact['gd$phoneNumber'][0]['$t'] : '';
                    $data['email'] = $contact['gd$email'][0]['address'];
                    $data['address1'] = isset($contact['gd$postalAddress'][0]['$t']) ? $contact['gd$postalAddress'][0]['$t'] : '';
                    $data['city'] = isset($contact['gd$structuredPostalAddress'][0]['gd$city']) ? $contact['gd$structuredPostalAddress'][0]['gd$city'] : '';
                    $data['state'] = isset($contact['gd$structuredPostalAddress'][0]['gd$region']) ? $contact['gd$structuredPostalAddress'][0]['gd$region'] : '';
                    $data['country'] = isset($contact['gd$structuredPostalAddress'][0]['gd$country']) ? $contact['gd$structuredPostalAddress'][0]['gd$country'] : '';
                    $data['sales_rep'] = get_option('default_sales_rep');
                    $lead = Lead::updateOrCreate([
                        'email' => $contact['gd$email'][0]['address'],
                    ], $data);
                    $lead->tag('google');
                }
            }
            session(['lock_assigned_alert' => false]);

            toastr()->info('Leads created from Google contacts', langapp('response_status'));

            return redirect()->route('leads.index');
        } else {
            $url = $googleService->getAuthorizationUri();
            return redirect((string)$url);
        }
    }

    protected function applyFilter() {
        if ($this->request->filter === 'converted') {
            return $this->lead->apply(['converted' => 1])->whereNull('archived_at');
        }
        if ($this->request->filter === 'archived') {
            return $this->lead->apply(['archived' => 1]);
        }
        return $this->lead->query()->whereNull('archived_at');
    }

    protected function getDisplayType() {

        if (!is_null($this->request->view)) {
            session(['leadview' => $this->displayType]);
        }

        return session('leadview', $this->displayType);
    }

    private function getPage() {
        return langapp('leads');
    }
}
