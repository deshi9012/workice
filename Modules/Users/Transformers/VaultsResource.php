<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Users\Transformers\VaultResource;

class VaultsResource extends ResourceCollection
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
            'data' => VaultResource::collection($this->collection),
        ];
    }
}
