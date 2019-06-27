<?php

namespace Modules\Contracts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Contracts\Entities\Contract;
use Modules\Contracts\Entities\Signature;
use Modules\Contracts\Events\ContractRejected;
use Modules\Contracts\Events\ContractSigned;
use Modules\Contracts\Events\ContractViewed;

class GuestController extends Controller
{
    public function show(Contract $contract)
    {
        if (isset($contract->id)) {
            event(new ContractViewed($contract));
            $data['contract'] = $contract;

            return view('contracts::guest')->with($data);
        } else {
            abort(403, 'Contract not found');
        }
    }
    public function approve(Contract $contract)
    {
        if (\Auth::check()) {
            if (isAdmin()) {
                return view('contracts::modal.sign_failed');
            }
        }
        if (isset($contract->id)) {
            $data['contract'] = $contract;

            return view('contracts::modal.client_sign')->with($data);
        }
    }

    public function dismiss(Contract $contract)
    {
        if (\Auth::check()) {
            if (isAdmin()) {
                return view('contracts::modal.sign_failed');
            }
        }
        if (isset($contract->id)) {
            $data['contract'] = $contract;
            return view('contracts::modal.client_dismiss')->with($data);
        }
    }

    public function pdf(Contract $contract)
    {
        if (isset($contract->id)) {
            return $contract->pdf();
        }
    }

    public function sign(Contract $contract, Request $request)
    {
        $request->validate(['contract_id' => 'required|numeric', 'signature' => 'required|in:' . $contract->company->contact->name]);

        $signature = Signature::firstOrCreate(
            ['user_id' => $contract->company->primary_contact, 'contract_id' => $contract->id],
            $request->all()
        );
        $contract->update(['client_sign_id' => $signature->id]);
        if ($contract->client_sign_id > 0 && $contract->contractor_sign_id > 0) {
            event(new ContractSigned($contract));
        }

        $data['message']  = langapp('activity_approve_contract');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function reject(Contract $contract, Request $request)
    {
        $request->validate(['contract_id' => 'required|numeric', 'reason' => 'required']);
        if ($request->has('reason')) {
            event(new ContractRejected($contract, $request->reason));
        }
        $data['message']  = langapp('activity_reject_contract');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }
}
