<?php

namespace Modules\Updates\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Updates\Transformers\UpdateResource;

class UpdatesResource extends ResourceCollection
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
            'data' => UpdateResource::collection($this->collection),
        ];
    }
}
