<?php

namespace Modules\Invoices\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class InvoiceResource extends Resource
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
            'type'       => 'invoices',
            'id'         => (string) $this->id,
            'attributes' => [
                'id'           => (int) $this->id,
                'reference_no' => $this->reference_no,
                'title'        => $this->title,
                'due_date'     => $this->due_date->toIso8601String(),
                'tax'          => $this->tax,
                'tax2'         => $this->tax2,
                'discount'     => $this->discount,
                'currency'     => $this->currency,
                'extra_fee'    => $this->extra_fee,
                'status'       => $this->status,
                'payable'      => $this->payable,
                'tax_total'    => $this->tax_total,
                'paid_amount'  => $this->paid_amount,
                'late_fee'     => $this->late_fee,
                'balance'      => $this->balance,
                'business'     => [
                    'id'             => (int) optional($this->company)->id,
                    'name'           => optional($this->company)->name,
                    'contact_person' => optional(optional($this->company)->contact)->email,
                ],
                'created_at'   => $this->created_at->toIso8601String(),
                'updated_at'   => $this->updated_at->toIso8601String(),
            ],
        ];
    }
}
