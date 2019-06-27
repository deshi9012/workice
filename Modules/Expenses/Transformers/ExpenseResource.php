<?php

namespace Modules\Expenses\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ExpenseResource extends Resource
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
            'type'          => 'expenses',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'code' => $this->code,
                'amount' => $this->amount,
                'before_tax' => $this->before_tax,
                'currency' => $this->currency,
                'billable' => $this->billable,
                'category' => $this->category,
                'vendor' => $this->vendor,
                'tax' => $this->tax,
                'tax2' => $this->tax2,
                'taxed' => $this->taxed,
                'expense_date' => $this->expense_date->toIso8601String(),
                'billed' => $this->invoiced ? true : false,
                'project_id' => $this->project_id,
                'client_id' => $this->client_id,
                'invoiced_id' => $this->invoiced_id,
                'is_recurring' => $this->is_recurring,
                'frequency' => $this->frequency,
                'next_recur_date' => $this->next_recur_date,
                'recur_starts' => $this->recur_starts,
                'recur_ends' => $this->recur_ends,
                'exchange_rate' => $this->exchange_rate,
                'is_visible' => $this->is_visible,
                'notes' => $this->notes,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
