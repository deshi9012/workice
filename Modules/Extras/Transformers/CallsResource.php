<?php

namespace Modules\Extras\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Extras\Transformers\CallResource;

class CallsResource extends ResourceCollection
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
            'data' => CallResource::collection($this->collection),
        ];
    }
}
