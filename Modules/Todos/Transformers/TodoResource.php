<?php

namespace Modules\Todos\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class TodoResource extends Resource
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
            'type'          => 'todos',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'subject' => $this->subject,
                'order' => (int)$this->order,
                'parent' => (int)$this->parent,
                'due_date' => $this->due_date->toIso8601String(),
                'notes' => $this->notes,
                'assignee' => [
                    'id' => (int)$this->assignee,
                    'name' => optional($this->agent)->name
                ],
                'reminded_at' => is_null($this->reminded_at) ? $this->reminded_at : dateIso8601String($this->reminded_at),
                'entity' => [
                    'id' => (int)$this->todoable->id,
                    'name' => $this->todoable->name,
                ],
                'is_visible' => (int)$this->is_visible,
                'completed' => (int)$this->completed,
                'user_id' => (int)$this->user_id,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
