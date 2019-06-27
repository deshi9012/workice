<?php

namespace Modules\Tasks\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class TaskResource extends Resource
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
                'type' => 'tasks',
                'id' => (string)$this->id,
                'attributes' => [
                    'id' => (int)$this->id,
                    'name' => $this->name,
                    'project' => [
                        'id' => $this->project_id,
                        'name' => optional($this->AsProject)->name
                    ],
                    'milestone' => [
                        'id' => $this->milestone_id,
                        'name' => optional($this->AsMilestone)->milestone_name
                    ],
                    'progress' => $this->progress,
                    'hourly_rate' => $this->hourly_rate,
                    'estimated_hours' => $this->estimated_hours,
                    'estimated_price' => $this->est_price,
                    'hours' => toHours($this->time),
                    'start_date' => $this->start_date->toIso8601String(),
                    'due_date' => $this->due_date->toIso8601String(),
                    'description' => $this->description,
                    'updated_at' => $this->updated_at->toIso8601String(),
                    'created_at' => $this->created_at->toIso8601String(),
                ]
        ];
    }
}
