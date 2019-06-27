<?php

namespace Modules\Contracts\Entities;

use App\Traits\Actionable;
use Illuminate\Database\Eloquent\Model;

class Clause extends Model
{
    use Actionable;
    
    protected $fillable = ['name', 'clause'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => \Modules\Contracts\Events\ClauseUpdated::class,
    ];

    public function readClause($clause)
    {
        return $this->whereName($clause)->first()->clause;
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = snake_case($value);
    }
}
