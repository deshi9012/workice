<?php

namespace Modules\Activity\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes, BelongsToUser;

    protected $guarded = [];

    public function actionable()
    {
        return $this->morphTo();
    }

    public function getMessageAttribute($value)
    {
        return trans('activity.' . $this->action, ['value1' => '<strong>' . $this->value1 . '</strong>', 'value2' => '<strong>' . $this->value2 . '</strong>']);
    }

    /**
     * Set default url if missing
     *
     * @param  string $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        if (empty($value)) {
            return '/';
        }
        return $value;
    }
}
