<?php

namespace Modules\Estimates\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Estimates\Transformers\EstimateResource;

class EstimatesResource extends ResourceCollection
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
            'data' => EstimateResource::collection($this->collection),
        ];
    }
}
