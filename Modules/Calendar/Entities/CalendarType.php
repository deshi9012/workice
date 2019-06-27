<?php

namespace Modules\Calendar\Entities;

use Illuminate\Database\Eloquent\Model;

class CalendarType extends Model
{
    protected $fillable = ['name'];

    protected $table = 'calendars';
}
