<?php

namespace Modules\Items\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemsResource extends ResourceCollection
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
            'data' => \Modules\Items\Transformers\ItemResource::collection($this->collection),
        ];
    }
}
