<?php

namespace Modules\Contracts\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Contracts\Entities\Contract;

class ContractsController extends Controller
{
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
     * Contract model
     *
     * @var \Modules\Contracts\Entities\Contract
     */
    protected $contract;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_contracts']);
        $this->request  = $request;
        $this->contract = new Contract;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['sign'] = true;
        $data['page'] = $this->getPage();
        //$data['contracts'] = $this->getContracts();

        return view('contracts::index')->with($data);
    }
    /**
     * Show contract create page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['page'] = $this->getPage();

        return view('contracts::create')->with($data);
    }
    /**
     * Show edit contract page
     *
     * @param  \Modules\Contracts\Entities\Contract $contract
     * @return \Illuminate\View\View
     */
    public function edit(Contract $contract)
    {
        $data['page']     = $this->getPage();
        $data['contract'] = $contract;

        return view('contracts::update')->with($data);
    }
    /**
     * View contract page
     *
     * @param  \Modules\Contracts\Entities\Contract $contract
     * @return \Illuminate\View\View
     */
    public function view(Contract $contract)
    {
        $data['page']     = $this->getPage();
        $data['contract'] = $contract;
        $data['sign']     = true;

        return view('contracts::view')->with($data);
    }
    // Show contract activities
    public function activity(Contract $contract)
    {
        $data['page']       = $this->getPage();
        $data['activities'] = $contract->activities;

        return view('partial.activity')->with($data);
    }
    // Sign and send a contract
    public function send(Contract $contract)
    {
        $data['page']     = $this->getPage();
        $data['contract'] = $contract;
        return view('contracts::modal.sign')->with($data);
    }
    // Send contract reminder
    public function remind(Contract $contract)
    {
        $data['page']     = $this->getPage();
        $data['contract'] = $contract;

        return view('contracts::modal.remind')->with($data);
    }
    // Share contract link
    public function share($id)
    {
        $data['page'] = $this->getPage();
        $data['id']   = $id;

        return view('contracts::modal.share')->with($data);
    }

    /**
     * Show Duplicate contract modal
     */
    public function copy(Contract $contract)
    {
        $data['contract'] = $contract;

        return view('contracts::modal.copy')->with($data);
    }

    // Download contract as PDF
    public function pdf(Contract $contract)
    {
        if (isset($contract->id)) {
            return $contract->pdf();
        }
        abort(404);
    }
    // Show contract delete modal
    public function delete(Contract $contract)
    {
        $data['contract'] = $contract;

        return view('contracts::modal.delete')->with($data);
    }

    private function getContracts()
    {
        switch ($this->request->filter) {
            case 'viewed':
                return $this->contract->viewed()->orderBy('id', 'desc')->get();
                break;
            case 'draft':
                return $this->contract->isDraft()->orderBy('id', 'desc')->get();
                break;
            case 'signed':
                return $this->contract->done()->orderBy('id', 'desc')->get();
                break;
            case 'sent':
                return $this->contract->sent()->orderBy('id', 'desc')->get();
                break;
            case 'expired':
                return $this->contract->expired()->orderBy('id', 'desc')->get();
                break;

            default:
                return $this->contract->where('signed', '0')->orderBy('id', 'desc')->get();
                break;
        }
    }

    private function getPage()
    {
        return langapp('contracts');
    }
}
