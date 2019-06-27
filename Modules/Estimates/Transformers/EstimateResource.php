<?php

namespace Modules\Estimates\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class EstimateResource extends Resource
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
            'type'          => 'estimates',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'reference_no' => $this->reference_no,
                'title' => $this->title,
                'client_id' => (int)$this->client_id,
                'deal_id' => (int)$this->deal_id,
                'due_date' => dateIso8601String($this->due_date),
                'tax' => $this->tax,
                'tax2' => $this->tax2,
                'discount' => $this->discount,
                'discount_percent' => $this->discount_percent,
                'currency' => $this->currency,
                'notes' => $this->notes,
                'sent_at' => $this->sent_at,
                'status' => $this->status,
                'viewed_at' => $this->viewed_at,
                'invoiced_id' => $this->invoiced_id,
                'invoiced_at' => $this->invoiced_at,
                'accepted_time' => $this->accepted_time,
                'rejected_time' => $this->rejected_time,
                'rejected_reason' => $this->rejected_reason,
                'exchange_rate' => $this->exchange_rate,
                'sub_total' => $this->sub_total,
                'amount' => $this->amount,
                'discounted' => $this->discounted,
                'tax1_amount' => $this->tax1_amount,
                'tax2_amount' => $this->tax2_amount,
                'archived_at' => $this->archived_at,
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
