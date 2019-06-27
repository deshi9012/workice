<?php

namespace Modules\Clients\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ClientResource extends Resource
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
            'type'          => 'clients',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'name' => $this->name,
                'code' => $this->code,
                'email' => $this->email,
                'contact' => [
                    'id' => $this->primary_contact,
                    'email' => optional($this->contact)->email,
                    'name' => optional($this->contact)->name,
                ],
                'address' => [
                    'address1' => $this->address1,
                    'address2' => $this->address2,
                    'city' => $this->city,
                    'state' => $this->state,
                    'zipcode' => $this->zip_code,
                    'country' => $this->country
                ],
                'website' => $this->website,
                'phone' => $this->phone,
                'mobile' => $this->mobile,
                'tax_number' => $this->tax_number,
                'currency' => $this->currency,
                'expense' => $this->expense,
                'balance' => $this->balance,
                'paid' => $this->paid,
                'social' => [
                    'skype' => $this->skype,
                    'facebook' => $this->facebook,
                    'twitter' => $this->twitter,
                    'linkedin' => $this->linkedin
                ],
                'notes' => $this->getOriginal('notes'),
                'logo' => $this->logo,
                'unsubscribed_at' => is_null($this->unsubscribed_at) ? $this->unsubscribed_at : dateIso8601String($this->unsubscribed_at),
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
