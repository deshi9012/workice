<?php

namespace Modules\Subscriptions\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class SubscriptionResource extends Resource
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
            'type'          => 'subscriptions',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => (int)$this->id,
                'name' => $this->name,
                'stripe_id' => $this->stripe_id,
                'stripe_plan' => $this->stripe_plan,
                'quantity' => $this->quantity,
                'trial_ends_at' => dateIso8601String($this->trial_ends_at),
                'ends_at' => dateIso8601String($this->ends_at),
                'business' => [
                    'id' => (int)optional($this->owner)->id,
                    'name' => optional($this->owner)->name,
                    'contact_person' => optional($this->owner->contact)->email,
                ],
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
