<?php

namespace Modules\Todos\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Todos\Transformers\TodoResource;

class TodosResource extends ResourceCollection
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
            'data' => TodoResource::collection($this->collection),
        ];
    }
}
