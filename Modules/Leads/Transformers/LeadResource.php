<?php

namespace Modules\Leads\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class LeadResource extends Resource
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
            'type'          => 'leads',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => (int)$this->id,
                'name' => $this->name,
                'source' => [
                    'id' => $this->source,
                    'name' => $this->AsSource->name
                ],
                'email' => $this->email,
                'stage' => [
                    'id' => $this->stage_id,
                    'name' => optional($this->status)->name
                ],
                'job_title' => $this->job_title,
                'company' => $this->company,
                'phone' => $this->phone,
                'mobile' => $this->mobile,
                'address' => [
                    'address1' => $this->address1,
                    'address2' => $this->address2,
                    'city' => $this->city,
                    'state' => $this->state,
                    'zipcode' => $this->zipcode,
                    'country' => $this->country
                ],
                'timezone' => $this->timezone,
                'website' => $this->website,
                'social' => [
                    'skype' => $this->skype,
                    'facebook' => $this->facebook,
                    'twitter' => $this->twitter,
                    'linkedin' => $this->linkedin
                ],
                'agent' => [
                    'id' => $this->sales_rep,
                    'name' => optional($this->agent)->name,
                    'email' => optional($this->agent)->email
                ],
                'lead_score' => $this->lead_score,
                'due_date' => is_null($this->due_date) ? $this->due_date : dateIso8601String($this->due_date),
                'lead_value' => $this->computed_value,
                'message' => $this->message,
                'has_activity' => $this->has_activity,
                'has_email' => $this->has_email,
                'next_followup' => is_null($this->next_followup) ? $this->next_followup : dateIso8601String($this->next_followup),
                'unsubscribed_at' => is_null($this->unsubscribed_at) ? $this->unsubscribed_at : dateIso8601String($this->unsubscribed_at),
                'archived_at' => is_null($this->archived_at) ? $this->archived_at : dateIso8601String($this->archived_at),
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
