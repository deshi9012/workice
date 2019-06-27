<?php

namespace Modules\Payments\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Payments\Transformers\PaymentResource;

class PaymentsResource extends ResourceCollection
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
            'data' => PaymentResource::collection($this->collection),
        ];
    }
}
