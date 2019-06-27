<?php

namespace Modules\Teams\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Teams\Events\AssignmentDeleted;

class Assignment extends Model
{
    use BelongsToUser, SoftDeletes;

    protected $guarded = [];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => AssignmentDeleted::class,
    ];

    public function assignable()
    {
        return $this->morphTo();
    }
}
