<?php

namespace Modules\Contracts\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ContractResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  mixed $request \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'contracts',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'title' => $this->contract_title,
                'start_date' => $this->start_date->toIso8601String(),
                'end_date' => $this->end_date->toIso8601String(),
                'expiry_date' => $this->expiry_date->toIso8601String(),
                'rate_is_fixed' => $this->rate_is_fixed,
                'fixed_rate' => $this->fixed_rate,
                'hourly_rate' => $this->hourly_rate,
                'currency' => $this->currency,
                'license_owner' => $this->license_owner,
                'payment_terms' => $this->payment_terms,
                'late_payment_fee' => $this->late_payment_fee,
                'late_fee_percent' => $this->late_fee_percent,
                'termination_notice' => $this->termination_notice,
                'cancelation_fee' => $this->cancelation_fee,
                'deposit_required' => $this->deposit_required,
                'signed' => $this->signed,
                'services' => $this->services,
                'client_rights' => $this->client_rights,
                'portfolio_rights' => $this->portfolio_rights,
                'non_compete' => $this->non_compete,
                'feedbacks' => $this->feedbacks,
                'appropriate_conduct' => $this->appropriate_conduct,
                'annotations' => $this->annotations,
                'description' => $this->description,
                'viewed_at' => is_null($this->viewed_at) ? $this->viewed_at : dateIso8601String($this->viewed_at),
                'sent_at' => is_null($this->sent_at) ? $this->sent_at : dateIso8601String($this->sent_at),
                'is_draft' => $this->is_visible ? false : true,
                'rejected_at' => is_null($this->rejected_at) ? $this->rejected_at : dateIso8601String($this->rejected_at),
                'rejected_reason' => $this->rejected_reason,
                'user_id' => $this->user_id,
                'business' => [
                    'id' => (int)optional($this->company)->id,
                    'name' => optional($this->company)->name,
                    'contact_person' => optional($this->company->contact)->email,
                ],
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
