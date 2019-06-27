<?php

namespace Modules\Leads\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LeadsResource extends ResourceCollection
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
            'data' => \Modules\Leads\Transformers\LeadResource::collection($this->collection),
        ];
    }
}
