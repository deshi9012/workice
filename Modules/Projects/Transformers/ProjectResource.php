<?php

namespace Modules\Projects\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ProjectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'projects',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'name' => $this->name,
                'code' => $this->code,
                'description' => $this->description,
                'client_id' => $this->client_id,
                'business' => [
                    'id' => (int)optional($this->company)->id,
                    'name' => optional($this->company)->name,
                    'contact_person' => optional(optional($this->company)->contact)->email,
                ],
                'currency' => $this->currency,
                'start_date' => dateIso8601String($this->start_date),
                'due_date' => dateIso8601String($this->due_date),
                'hourly_rate' => $this->hourly_rate,
                'fixed_price' => $this->fixed_price,
                'progress' => $this->progress,
                'notes' => $this->notes,
                'manager' => $this->manager,
                'status' => $this->status,
                'estimate_hours' => $this->estimate_hours,
                'used_budget' => $this->used_budget,
                'billable_time' => $this->billable_time,
                'unbillable_time' => $this->unbillable_time,
                'unbilled' => $this->unbilled,
                'sub_total' => $this->sub_total,
                'total_expenses' => $this->total_expenses,
                'contract_id' => $this->contract_id,
                'billing_method' => $this->billing_method,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
