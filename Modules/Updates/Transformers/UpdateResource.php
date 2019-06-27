<?php

namespace Modules\Updates\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class UpdateResource extends Resource
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
            'type'          => 'updates',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => (int)$this->id,
                'build' => $this->build,
                'code' => $this->code,
                'date' => $this->date,
                'version' => $this->version,
                'title' => $this->title,
                'description' => $this->description,
                'filename' => $this->filename,
                'importance' => $this->importance,
                'dependencies' => $this->dependencies,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
