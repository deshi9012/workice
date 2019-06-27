<?php

namespace Modules\Users\Entities;

use App\Entities\Department;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class UserHasDepartment extends Model
{
    use BelongsToUser;
    
    protected $fillable = ['user_id', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
