<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Users\Transformers\UserResource;

class UsersResource extends ResourceCollection
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
            'data' => UserResource::collection($this->collection),
        ];
    }
}
