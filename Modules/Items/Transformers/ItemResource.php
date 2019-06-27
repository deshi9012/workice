<?php

namespace Modules\Items\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ItemResource extends Resource
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
            'type'          => 'items',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => (int)$this->id,
                'name' => $this->name,
                'description' => $this->description,
                'entity' => [
                    'id' => $this->itemable->id,
                    'name' => $this->itemable->name
                ],
                'tax_rate' => $this->tax_rate,
                'quantity' => $this->quantity,
                'unit_cost' => $this->unit_cost,
                'discount' => $this->discount,
                'tax_total' => $this->tax_total,
                'total_cost' => $this->total_cost,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
