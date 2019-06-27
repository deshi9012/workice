<?php

namespace Modules\Tickets\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Tickets\Transformers\TicketResource;

class TicketsResource extends ResourceCollection
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
            'data' => TicketResource::collection($this->collection),
        ];
    }
}
