<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'type'       => 'users',
            'id'         => (string) $this->id,
            'attributes' => [
                'id'              => $this->id,
                'name'            => $this->name,
                'username'        => $this->username,
                'email'           => $this->email,
                'last_login'      => $this->last_login,
                'unsubscribed_at' => $this->unsubscribed_at,
                'profile'         => [
                    'business'        => [
                        'id'   => $this->company,
                        'name' => optional($this->business)->name,
                    ],
                    'job_title'       => $this->job_title,
                    'city'            => $this->city,
                    'country'         => $this->country,
                    'address'         => $this->address,
                    'state'           => $this->state,
                    'zipcode'         => $this->zip_code,
                    'avatar'          => $this->avatar,
                    'hourly_rate'     => $this->hourly_rate,
                    'email_signature' => $this->email_signature,
                ],
                'created_at'      => $this->created_at->toIso8601String(),
                'updated_at'      => $this->updated_at->toIso8601String(),
            ],
        ];
    }
}
