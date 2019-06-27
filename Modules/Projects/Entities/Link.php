<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Entities\Project;

class Link extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id();
    }
}
