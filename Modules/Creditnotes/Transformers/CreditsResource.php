<?php

namespace Modules\Creditnotes\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Creditnotes\Transformers\CreditResource;

class CreditsResource extends ResourceCollection
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
            'data' => CreditResource::collection($this->collection),
        ];
    }
}
