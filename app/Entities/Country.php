<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['code', 'name'];
    public $timestamps = false;
}
