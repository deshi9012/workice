<?php

namespace Modules\Comments\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
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
            'type'          => 'comments',
            'id'            => (string)$this->id,
            'attributes'    => [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'entity' => [
                    'id' => $this->commentable->id,
                    'name' => $this->commentable->name
                ],
                'parent' => $this->parent,
                'message' => $this->message,
                'unread' => $this->unread,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}
