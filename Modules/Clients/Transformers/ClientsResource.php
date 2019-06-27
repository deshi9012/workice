<?php

namespace Modules\Clients\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Clients\Transformers\ClientResource;

class ClientsResource extends ResourceCollection
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
            'data' => ClientResource::collection($this->collection),
        ];
    }
}
