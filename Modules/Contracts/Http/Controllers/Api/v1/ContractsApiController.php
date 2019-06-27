<?php

namespace Modules\Contracts\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Contracts\Emails\ContractReminder;
use Modules\Contracts\Entities\Contract;
use Modules\Contracts\Entities\Signature;
use Modules\Contracts\Events\ContractSent;
use Modules\Contracts\Events\ContractSigned;
use Modules\Contracts\Events\ContractUpdated;
use Modules\Contracts\Http\Requests\ContractRequest;
use Modules\Contracts\Http\Requests\SignRequest;
use Modules\Contracts\Transformers\ContractResource;
use Modules\Contracts\Transformers\ContractsResource;

class ContractsApiController extends Controller
{
    protected $request;
    protected $contract;

    public function __construct(Request $request)
    {
        $this->request  = $request;
        $this->contract = new Contract;
        $this->middleware('localize');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */

    public function index()
    {
        $contracts = $this->applyFilters()->with(['company:id,name,primary_contact'])->orderByDesc('id')->paginate(40);
        $contracts = new ContractsResource($contracts);
        if ($this->request->has('json')) {
            $data['contracts'] = $contracts;
            return view('contracts::_ajax._contracts')->with($data);
        }
        return response($contracts, Response::HTTP_OK);
    }

    private function applyFilters()
    {
        $filter = $this->request->filter;
        if ($filter === 'viewed') {
            return $this->contract->apply(['viewed' => 1, 'signed' => 0]);
        }
        if ($filter === 'draft') {
            return $this->contract->apply(['visible' => 0, 'signed' => 0]);
        }
        if ($filter === 'signed') {
            return $this->contract->apply(['signed' => 1]);
        }
        if ($filter === 'expired') {
            return $this->contract->apply(['expired' => 1, 'signed' => 0]);
        }
        if ($filter === 'rejected') {
            return $this->contract->apply(['rejected' => 1, 'signed' => 0]);
        }
        if ($filter === 'sent') {
            return $this->contract->apply(['sent' => 1, 'signed' => 0]);
        }
        return $this->contract->query()->where('signed', 0)->whereNull('rejected_at');
    }

    public function save(ContractRequest $request)
    {
        $contract = $this->contract->create($request->all());

        return ajaxResponse(
            [
                'id'       => $contract->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('contracts.view', $contract->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }

    public function update(ContractRequest $request, $id = null)
    {
        $contract = $this->contract->findOrFail($id);
        $this->authorize('update', $contract);
        if ($contract->signed == 0) {
            $contract->update($request->except('id'));
        }
        event(new ContractUpdated($contract));

        return ajaxResponse(
            [
                'id'       => $contract->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('contracts.view', $contract->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function sign(SignRequest $request, $id = null)
    {
        $contract  = $this->contract->findOrFail($id);
        $signature = Signature::firstOrCreate(
            ['user_id' => \Auth::id(), 'contract_id' => $contract->id],
            $request->all()
        );

        if ($contract->client_id == \Auth::user()->profile->company) {
            $contract->client_sign_id = $signature->id;
        } else {
            $contract->contractor_sign_id = $signature->id;
        }
        $contract->save();
        if ($contract->client_sign_id > 0 && $contract->contractor_sign_id > 0) {
            event(new ContractSigned($contract));
        }
        \Mail::to($contract->company->contact)->send(new ContractReminder($contract));
        event(new ContractSent($contract));

        return ajaxResponse(
            [
                'id'       => $contract->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => route('contracts.view', $contract->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function remind($id = null)
    {
        $contract = $this->contract->findOrFail($id);
        \Mail::to($contract->company->contact)->send(new ContractReminder($contract));
        return ajaxResponse(
            [
                'id'       => $contract->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => $this->request->url,
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Show the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $contract = $this->contract->findOrFail($id);
        $this->authorize('view', $contract);
        return response(new ContractResource($contract), Response::HTTP_OK);
    }

    /**
     * Duplicate contract
     */
    public function copy($id = null)
    {
        $contract    = $this->contract->findOrFail($id);
        $newContract = $contract->replicate();
        $newContract->save();
        return ajaxResponse(
            [
                'id'       => $newContract->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('contracts.view', $newContract->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function delete($id = null)
    {
        $contract = $this->contract->findOrFail($id);
        $this->authorize('delete', $contract);
        $contract->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('contracts.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
