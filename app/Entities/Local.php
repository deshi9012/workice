<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'locales';
}
