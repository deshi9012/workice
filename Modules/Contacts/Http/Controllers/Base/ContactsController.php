<?php

namespace Modules\Contacts\Http\Controllers\Base;

use App\Entities\CsvData;
use App\Helpers\ExcelImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVRequest;
use Illuminate\Http\Request;
use Modules\Clients\Entities\Client;
use Modules\Contacts\Emails\ContactMail;
use Modules\Contacts\Exports\ContactsExport;
use Modules\Contacts\Http\Requests\MailRequest;
use Modules\Users\Entities\Profile;
use Modules\Users\Entities\User;

class ContactsController extends Controller
{
    /**
     * The page name
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

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_contacts']);
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = $this->getPage();
        return view('contacts::index')->with($data);
    }
    /**
     * New client form
     *
     * @param  string $client
     * @return \Illuminate\View\View
     */
    public function create($client = null)
    {
        $data['page']   = $this->getPage();
        $data['client'] = $client;
        return view('contacts::modal.create')->with($data);
    }
    /**
     * Send email to client
     *
     * @param  \Modules\Users\Entities\User $contact
     * @return \Illuminate\View\View
     */
    public function email(User $contact)
    {
        $data['page']    = $this->getPage();
        $data['contact'] = $contact;

        return view('contacts::send')->with($data);
    }
    /**
     * Process sending email
     *
     * @param  \Modules\Contacts\Http\Requests\MailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(MailRequest $request)
    {
        $user = User::findOrFail($request->id);
        $when = empty($request->reserved_at) ? now()->addMinutes(1) : dateParser($request->reserved_at);
        $mail = $user->emails()->create(
            [
                'to'          => $request->id,
                'from'        => \Auth::id(),
                'subject'     => $request->subject,
                'message'     => str_replace("{name}", $user->name, $request->message),
                'reserved_at' => $when->toDateTimeString(),
                'meta'        => ['sender' => \Auth::user()->email, 'to' => $user->email],
            ]
        );
        if ($request->hasFile('uploads')) {
            $this->makeUploads($mail, $request);
        }
        \Mail::to($user)->later($when, new ContactMail($mail, \Auth::user()->profile->email_signature));
        $data['message']  = langapp('sent_successfully');
        $data['redirect'] = $request->url;

        return ajaxResponse($data);
    }

    protected function makeUploads($mail, $request)
    {
        $request->request->add(['module' => 'emails']);
        $request->request->add(['module_id' => $mail->id]);
        $request->request->add(['title' => $mail->subject]);
        $request->request->add(['description' => 'Email ' . $mail->subject . ' file']);

        return (new \Modules\Files\Helpers\Uploader)->save('uploads/emails', $request);
    }
    /**
     * Import contact form
     *
     * @return \Illuminate\View\View
     */
    public function import()
    {
        if ($this->request->type == 'google') {
            return $this->importGoogleContacts();
        }
        $data['page'] = $this->getPage();
        return view('contacts::uploadcsv')->with($data);
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
            $csv_data_file = CsvData::create(
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

        return view('contacts::import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'))->with($dt);
    }

    public function processImport()
    {
        $validator = \Validator::make(
            array_flip($this->request->fields),
            [
                'name'    => 'required',
                'company' => 'required',
                'email'   => 'required',
            ]
        )->validate();
        (new \Modules\Contacts\Helpers\ContactCsvProcessor)->import($this->request);

        $data['message']  = langapp('data_imported');
        $data['redirect'] = route('contacts.index');

        return ajaxResponse($data);
    }
    /**
     * Show edit contact form
     *
     * @param  \Modules\Users\Entities\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $data['page']    = $this->getPage();
        $data['contact'] = $user;

        return view('contacts::modal.update')->with($data);
    }

    public function view(User $user)
    {
        $data['page']    = $this->getPage();
        $data['contact'] = $user;

        return view('contacts::view')->with($data);
    }
    // Make primary contact
    public function makePrimary(Client $client, $user = null)
    {
        $client->update(['primary_contact' => $user]);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect(url()->previous());
    }

    public function search()
    {
        $data['page']     = $this->getPage();
        $data['contacts'] = Profile::with(['user:id,username,email,name', 'business:id,name,currency,expense,balance,paid,primary_contact'])
            ->contacts()->whereHas('user', function ($query) {
                $query->where('name', 'LIKE', "%{$this->request->keyword}%");
                $query->orWhere('email', 'LIKE', "%{$this->request->keyword}%");
            })->get()->take(20);
        return view('contacts::search')->with($data);
    }

    public function importGoogleContacts()
    {
        $code          = $this->request->code;
        $googleService = \OAuth::consumer('Google', route('contacts.import.callback'));
        if (!is_null($code)) {
            $token  = $googleService->requestAccessToken($code);
            $result = json_decode($googleService->request('https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=1500'), true);

            foreach ($result['feed']['entry'] as $contact) {
                if (isset($contact['gd$email'])) {
                    $data                         = [];
                    $data['user']['name']         = isset($contact['title']['$t']) ? $contact['title']['$t'] : $contact['gd$email'][0]['address'];
                    $data['profile']['job_title'] = isset($contact['gd$organization'][0]['gd$orgTitle']['$t']) ? $contact['gd$organization'][0]['gd$orgTitle']['$t'] : '';
                    $data['client']['name']       = isset($contact['gd$organization'][0]['gd$orgName']['$t']) ? $contact['gd$organization'][0]['gd$orgName']['$t'] : $data['user']['name'];
                    $data['profile']['phone']     = isset($contact['gd$phoneNumber'][0]['$t']) ? $contact['gd$phoneNumber'][0]['$t'] : '';
                    $data['user']['email']        = $contact['gd$email'][0]['address'];
                    $data['user']['username']     = $contact['gd$email'][0]['address'];
                    $data['client']['email']      = $contact['gd$email'][0]['address'];
                    $data['client']['address1']   = isset($contact['gd$postalAddress'][0]['$t']) ? $contact['gd$postalAddress'][0]['$t'] : '';
                    $data['client']['city']       = isset($contact['gd$structuredPostalAddress'][0]['gd$city']) ? $contact['gd$structuredPostalAddress'][0]['gd$city'] : '';
                    $data['client']['state']      = isset($contact['gd$structuredPostalAddress'][0]['gd$region']) ? $contact['gd$structuredPostalAddress'][0]['gd$region'] : '';
                    $data['client']['country']    = isset($contact['gd$structuredPostalAddress'][0]['gd$country']) ? $contact['gd$structuredPostalAddress'][0]['gd$country'] : '';

                    $user                       = User::firstOrCreate(['email' => $data['user']['email']], $data['user']);
                    $company                    = Client::firstOrCreate(['name' => $data['client']['name']], $data['client']);
                    $data['profile']['company'] = $company->id;
                    $user->profile->update($data['profile']);
                }
            }

            toastr()->info('Contacts imported from Google contacts', langapp('response_status'));

            return redirect()->route('contacts.index');
        } else {
            $url = $googleService->getAuthorizationUri();
            return redirect((string) $url);
        }
    }

    /**
     * Export Contacts as CSV.
     */
    public function export()
    {
        if (isAdmin()) {
            return (new ContactsExport)->download('contacts_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }

    private function getPage()
    {
        return langapp('contacts');
    }
}
