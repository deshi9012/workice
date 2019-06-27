<?php

namespace Modules\Contacts\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ContactResource extends Resource
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
            'type'          => 'contacts',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'name' => $this->name,
                'job_title' => $this->job_title,
                'email' => $this->user->email,
                'avatar' => $this->photo,
                'city' => $this->city,
                'country' => $this->country,
                'website' => $this->website,
                'hourly_rate' => $this->hourly_rate,
                'business' => [
                    'id' => (int)optional($this->business)->id,
                    'name' => optional($this->business)->name,
                    'contact_person' => optional($this->business->contact)->email,
                    'currency' => optional($this->business)->currency,
                    'balance' => optional($this->business)->balance,
                    'expense' => optional($this->business)->expense,
                    'paid' => optional($this->business)->paid,
                ],
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
