<?php

namespace Modules\Contacts\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Contacts\Transformers\ContactResource;

class ContactsResource extends ResourceCollection
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
            'data' => ContactResource::collection($this->collection),
        ];
    }
}
