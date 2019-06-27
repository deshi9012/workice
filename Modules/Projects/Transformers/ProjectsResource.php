<?php

namespace Modules\Projects\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Projects\Transformers\ProjectResource;

class ProjectsResource extends ResourceCollection
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
            'data' => ProjectResource::collection($this->collection),
        ];
    }
}
