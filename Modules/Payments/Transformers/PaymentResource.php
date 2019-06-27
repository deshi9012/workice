<?php

namespace Modules\Payments\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class PaymentResource extends Resource
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
            'type'       => 'payments',
            'id'         => (string) $this->id,
            'attributes' => [
                'id'             => (int) $this->id,
                'code'           => $this->code,
                'invoice_id'     => $this->invoice_id,
                'payment_method' => $this->paymentMethod->method_name,
                'currency'       => $this->currency,
                'amount'         => $this->amount,
                'notes'          => $this->notes,
                'payment_date'   => dateIso8601String($this->payment_date),
                'exchange_rate'  => $this->exchange_rate,
                'project_id'     => $this->project_id,
                'refunded'       => $this->is_refunded,
                'archived_at'    => $this->archived_at,
                'business'       => [
                    'id'             => (int) optional($this->company)->id,
                    'name'           => optional($this->company)->name,
                    'contact_person' => optional($this->company->contact)->email,
                ],
                'created_at'     => $this->created_at->toIso8601String(),
                'updated_at'     => $this->updated_at->toIso8601String(),
            ],
        ];
    }
}
