<?php

namespace Modules\Invoices\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Invoices\Transformers\InvoiceResource;

class InvoicesResource extends ResourceCollection
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
            'data' => InvoiceResource::collection($this->collection),
        ];
    }
}
