<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'code', 'name', 'active', 'progress'
    ];
    public $timestamps = false;

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
