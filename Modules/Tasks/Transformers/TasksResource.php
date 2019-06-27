<?php

namespace Modules\Tasks\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TasksResource extends ResourceCollection
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
            'data' => \Modules\Tasks\Transformers\TaskResource::collection($this->collection),
        ];
    }
}
