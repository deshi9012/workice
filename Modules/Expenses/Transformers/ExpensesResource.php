<?php

namespace Modules\Expenses\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Expenses\Transformers\ExpenseResource;

class ExpensesResource extends ResourceCollection
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
            'data' => ExpenseResource::collection($this->collection),
        ];
    }
}
