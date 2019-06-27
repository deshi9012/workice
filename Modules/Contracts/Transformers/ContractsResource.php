<?php

namespace Modules\Contracts\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Contracts\Transformers\ContractResource;

class ContractsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param mixed $request \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ContractResource::collection($this->collection),
        ];
    }
}
