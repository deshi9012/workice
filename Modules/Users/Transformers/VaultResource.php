<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class VaultResource extends Resource
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
            'type'          => 'vaults',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'key' => $this->key,
                'value' => $this->value,
                'entity' => [
                    'id' => $this->vaultable->id,
                    'name' => $this->vaultable->name
                ],
                'user_id' => $this->user_id,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
