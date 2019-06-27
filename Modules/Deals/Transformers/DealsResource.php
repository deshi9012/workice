<?php

namespace Modules\Deals\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Deals\Transformers\DealResource;

class DealsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  mixed $request \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => DealResource::collection($this->collection),
        ];
    }
}
