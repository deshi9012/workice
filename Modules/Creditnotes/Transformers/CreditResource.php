<?php

namespace Modules\Creditnotes\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class CreditResource extends Resource
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
            'type'          => 'credits',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'reference_no' => $this->reference_no,
                'client_id' => $this->client_id,
                'status' => $this->status,
                'currency' => $this->currency,
                'tax' => $this->tax,
                'amount' => $this->amount,
                'balance' => $this->balance,
                'exchange_rate' => $this->exchange_rate,
                'is_refunded' => $this->is_refunded,
                'archived_at' => $this->archived_at,
                'terms' => $this->terms,
                'notes' => $this->notes,
                'sent_at' => $this->sent_at,
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
