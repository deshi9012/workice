<?php

namespace Modules\Deals\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class DealResource extends Resource
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
            'type'          => 'deals',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => (int)$this->id,
                'title' => $this->title,
                'stage' => [
                    'id' => $this->stage_id,
                    'name' => $this->category->name
                ],
                'currency' => $this->currency,
                'deal_value' => $this->deal_value,
                'contact_person' => [
                    'id' => $this->id,
                    'email' => $this->contact->email
                ],
                'organization' => [
                    'id' => $this->organization,
                    'name' => $this->company->name,
                    'email' => $this->company->email,
                ],
                'due_date' => !is_null($this->due_time) ? dateIso8601String($this->due_time) : $this->due_time,
                'status' => $this->status,
                'won_time' => !is_null($this->won_time) ? dateIso8601String($this->won_time) : $this->won_time,
                'lost_time' => !is_null($this->lost_time) ? dateIso8601String($this->lost_time) : $this->lost_time,
                'lost_reason' => $this->lost_reason,
                'source' => [
                    'id' => $this->source,
                    'name' => $this->AsSource->name
                ],
                'pipeline' => [
                    'id' => $this->pipeline,
                    'name' => $this->pipe->name
                ],
                'user_id' => $this->user_id,
                'next_followup' => !is_null($this->next_followup) ? dateIso8601String($this->next_followup) : $this->next_followup,
                'archived_at' => !is_null($this->archived_at) ? dateIso8601String($this->archived_at) : $this->archived_at,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
