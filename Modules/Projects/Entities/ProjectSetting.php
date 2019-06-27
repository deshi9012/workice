<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectSetting extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'project_settings';
}
