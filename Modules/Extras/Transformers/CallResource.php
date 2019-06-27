<?php

namespace Modules\Extras\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class CallResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  mixed $request \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'calls',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => (int)$this->id,
                'user_id' => $this->user_id,
                'assignee' => [
                    'id' => $this->assignee,
                    'namee' => $this->agent->name
                ],
                'subject' => $this->subject,
                'duration' => $this->duration,
                'scheduled_date' => $this->scheduled_date,
                'reminder' => $this->reminder,
                'type' => $this->type,
                'result' => $this->result,
                'description' => $this->description,
                'cancelled_at' => is_null($this->cancelled_at) ? $this->cancelled_at : dateIso8601String($this->cancelled_at),
                'entity' => [
                    'id' => $this->phoneable->id,
                    'name' => $this->phoneable->name
                ],
                'notified_at' => is_null($this->notified_at) ? $this->notified_at : dateIso8601String($this->notified_at),
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
