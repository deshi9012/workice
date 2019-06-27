<?php

namespace Modules\Notes\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotesResource extends ResourceCollection
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
            'data' => \Modules\Notes\Transformers\NoteResource::collection($this->collection),
        ];
    }
}
